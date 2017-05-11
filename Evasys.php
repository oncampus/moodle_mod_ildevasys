<?php

require_once("EvasysClient.php");

class EvaSys {
    private $user;
    private $course;
    private $curl_url;
    private $curl_token;
    private $wsdl;
    private $header;
    private $soapuser;
    private $soappass;
    private $participation_url;
    private $proxy;
    private $proxyport;

    function __construct() {
        global $USER, $COURSE;

        $this->user = $USER;
        $this->course = $COURSE;
        $this->curl_url = get_config('ildevasys', 'curl_url');
        $this->curl_token = get_config('ildevasys', 'curl_token');
        $this->wsdl = get_config('ildevasys', 'wsdl');
        $this->header = get_config('ildevasys', 'header');
        $this->soapuser = get_config('ildevasys', 'soapuser');
        $this->soappass = get_config('ildevasys', 'soappass');
        $this->participation_url = get_config('ildevasys', 'participation_url');
        $this->proxy = get_config('ildevasys', 'proxy');
        $this->proxyport = get_config('ildevasys', 'proxyport');
    }

    public function getEvaluation($cm) {
        global $SESSION;
        $context = context_MODULE::instance($cm->id);

        if ((empty($this->wsdl)) || (empty($this->header)) || (empty($this->soapuser)) || (empty($this->soappass))) {
            if (has_capability('mod/ildevasys:addinstance', $context)) {
                return get_string('warning_missing_configuration_error', 'mod_ildevasys');
            } else {
                return false;
            }
        } else {
            $eva_info_found = false;
            $eva_exists = false;

            if (!empty($SESSION->ce)) {
                $course_evaluations = $SESSION->ce;
                foreach ($course_evaluations as $course_evaluation) {
                    $evaluation_course = $course_evaluation[0];
                    $evaluation_tan = $course_evaluation[2];
                    if ($this->course->id == $evaluation_course) {
                        $eva_info_found = true;
                        if ($evaluation_tan) {
                            $eva_exists = true;
                        }
                    }
                }
            } else {
                $course_evaluations = array();
            }

            if (!$eva_info_found) {
                try {
                    $evasys = new EvasysClient($this->wsdl, $this->header, $this->soapuser, $this->soappass, $this->proxy, $this->proxyport);
                } catch (Exception $e) {
                    $evasys = false;
                }

                if (!$evasys->client) {
                    if (has_capability('mod/ildevasys:addinstance', $context)) {
                        return get_string('warning_evays_configuration_error', 'mod_ildevasys');
                    } else {
                        return false;
                    }
                } else {
                    $fields = array(
                        "course" => $this->course->idnumber,
                        "user" => $this->user->username,
                        "token" => md5($this->course->idnumber . $this->user->username . $this->curl_token));
                    $surveys = $this->curlPost($this->curl_url, $fields);

                    if ($surveys) {
                        foreach ($surveys as $survey_id) {
                            $survey = $evasys->GetSurveyById($survey_id);

                            $survey_form = $survey->m_nFrmid;
                            $survey_id = $survey->m_nSurveyId;
                            $survey_period = $survey->m_oPeriod->m_nPeriodId;
                            $survey_open = $survey->m_nOpenState;
                            $survey_title = $survey->m_sTitle;
                            $survey_formtitle = 'Fragebogen zur Evaluation von Online-Lehrveranstaltungen';

                            if (!$teilnahmelink = $evasys->GetOnlineSurveyLinkByEmail($survey_id, $this->user->email)) {
                                return false;
                            } else {
                                $tanarray = explode('=', $teilnahmelink);
                                $tan = $tanarray[1];
                                $course_evaluations[] = array($this->course->id, $survey_title, $tan, $survey_formtitle);
                                $SESSION->ce = $course_evaluations;
                                $eva_exists = true;
                            }
                        }
                    }
                }

                if (!$eva_exists) {
                    $course_evaluations[] = array($this->course->id, false, false, false);
                    $SESSION->ce = $course_evaluations;
                }
            }

            if ($eva_exists) {
                foreach ($course_evaluations as $course_evaluation) {
                    $evaluation_course = $course_evaluation[0];
                    $evaluation_title = $course_evaluation[1];
                    $evaluation_tan = $course_evaluation[2];
                    $evaluation_formtitle = $course_evaluation[3];

                    if ($evaluation_course == $this->course->id) {
                        $output = ' <img src="https://moodle.oncampus.de/mod/ildevasys/pix/verkuerzter_fragebogen_orange.png" alt="Verkuerzter Fragebogen Banner">';
                        $output .= '<div class="text"><p>' . get_string('entrytext', 'mod_ildevasys') . '</p></div>';
                        $output .= '<iframe id="evaluation" src="' . $this->participation_url . $evaluation_tan . '" width="100%" height="550px" frameborder="0" scrolling="auto"></iframe>';

                        return $output;
                    }
                }
            } else {
                return false;
            }
        }

        return true;
    }

    private function curlPost($url, $postfields = null) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        if ($postfields != null) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
        }

        $cookiefile = '/tmp/' . uniqid() . 'cookies.tmp';
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);

        $result = curl_exec($ch);
        curl_close($ch);

        if ($postfields != null) {
            return (array)unserialize($result);
        } else {
            return $result;
        }
    }

}