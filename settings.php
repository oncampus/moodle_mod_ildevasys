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

defined('MOODLE_INTERNAL') || die;

$settings->add(new admin_setting_heading(            
	'headerconfig',            
	get_string('headerconfig', 'mod_ildevasys'),            
	get_string('descconfig', 'mod_ildevasys'),''    
)); 

$settings->add(new admin_setting_configtext(            
	'ildevasys/curl_url',            
	get_string('configlabel_curl_url', 'mod_ildevasys'),            
	get_string('configdesc_curl_url', 'mod_ildevasys'),''
));
$settings->add(new admin_setting_configtext(            
	'ildevasys/curl_token',            
	get_string('configlabel_curl_token', 'mod_ildevasys'),            
	get_string('configdesc_curl_token', 'mod_ildevasys'),''
));

$settings->add(new admin_setting_configtext(            
	'ildevasys/wsdl',            
	get_string('configlabel_wsdl', 'mod_ildevasys'),            
	get_string('configdesc_wsdl', 'mod_ildevasys'),''
));
$settings->add(new admin_setting_configtext(            
	'ildevasys/header',            
	get_string('configlabel_header', 'mod_ildevasys'),            
	get_string('configdesc_header', 'mod_ildevasys'),''
));
$settings->add(new admin_setting_configtext(            
	'ildevasys/soapuser',            
	get_string('configlabel_soapuser', 'mod_ildevasys'),            
	get_string('configdesc_soapuser', 'mod_ildevasys'),''
));
$settings->add(new admin_setting_configpasswordunmask(
	'ildevasys/soappass', 
	get_string('configlabel_soappass', 'mod_ildevasys'),
	get_string('configdesc_soappass', 'mod_ildevasys'), 
	'password'
));
$settings->add(new admin_setting_configtext(            
	'ildevasys/participation_url',            
	get_string('configlabel_participation_url', 'mod_ildevasys'),            
	get_string('configdesc_participation_url', 'mod_ildevasys'),''
));
$settings->add(new admin_setting_configtext(            
	'ildevasys/proxy',            
	get_string('configlabel_proxy', 'mod_ildevasys'),            
	get_string('configdesc_proxy', 'mod_ildevasys'),''
));
$settings->add(new admin_setting_configtext(            
	'ildevasys/proxyport',            
	get_string('configlabel_proxyport', 'mod_ildevasys'),            
	get_string('configdesc_proxyport', 'mod_ildevasys'),''
));