<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package mod_ildevasys
 * @copyright 2016 Fachhochschule Lübeck ILD
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * @param $feature
 * @return bool|null
 */
function ildevasys_supports($feature) {
    switch ($feature) {
        case FEATURE_MOD_INTRO:
            return false;
        case FEATURE_COMPLETION_TRACKS_VIEWS:
            return false;
        case FEATURE_COMPLETION_HAS_RULES:
            return false;
        case FEATURE_GRADE_HAS_GRADE:
            return false;
        case FEATURE_BACKUP_MOODLE2:
            return true;
        default:
            return null;
    }
}

/**
 * @param $data
 * @return mixed
 */
function ildevasys_add_instance($data) {
    global $DB;

    $data->timemodified = time();
    $data->id = $DB->insert_record('ildevasys', $data);

    return $data->id;
}

/**
 * @param $data
 * @return bool
 */
function ildevasys_update_instance($data) {
    global $DB;

    $data->timemodified = time();
    $data->id = $data->instance;

    $DB->update_record('ildevasys', $data);

    return true;
}

/**
 * @param $id
 * @return bool
 */
function ildevasys_delete_instance($id) {
    global $DB;

    if (!$ildevasys = $DB->get_record('ildevasys', array('id' => $id))) {
        return false;
    }

    $DB->delete_records('ildevasys', array('id' => $ildevasys->id));

    return true;
}

function ildevasys_cm_info_dynamic(cm_info $cm) {
    global $USER;

    if ($USER->editing != 1) {
        $cm->set_no_view_link();

        require_once('Evasys.php');
        $cmr = $cm->get_course_module_record();

        $evaluation = (new EvaSys())->getEvaluation($cmr);

        if ($evaluation !== false) {
            $cm->set_content($evaluation);
        } else {
            $cm->set_user_visible(false);
        }
    } else {
        if (is_siteadmin() == 0) {
            $cm->set_user_visible(false);
        }
    }
}