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

$string['modulename'] = 'EvaSys Evaluation';
$string['pluginname'] = 'EvaSys Evaluation';
$string['pluginadministration'] = 'EvaSys Evaluation';
$string['modulenameplural'] = 'EvaSys Evaluation';
$string['ildevasys:addinstance'] = 'Eine neue EvaSys Evaluation anlegen';
$string['name'] = 'Bezeichnung';

$string['headerconfig'] = 'Online Evaluation Konfiguration';
$string['descconfig'] = 'Globale Konfiguration der Soap-Schnittstelle zu Evasys';
$string['configlabel_wsdl'] = 'WSDL';
$string['configdesc_wsdl'] = 'URL zu WSDL: z.B. http://evaluation.xxx.de/evasys/services/SoapServer-V4.wsdl';
$string['configlabel_header'] = 'Header';
$string['configdesc_header'] = 'Soapheader: z.B. soapserver-v4.wsdl';
$string['configlabel_soapuser'] = 'Soapuser';
$string['configdesc_soapuser'] = 'Soapuser';
$string['configlabel_soappass'] = 'Soappass';
$string['configdesc_soappass'] = 'Soappass';
$string['configlabel_participation_url'] = 'alternative Teilname URL';
$string['configdesc_participation_url'] = 'alternative Teilnahme URL: z.B. https://evaluation.xxx.de/evasys/indexstud.php?tan=';
$string['configlabel_proxy'] = 'Proxy';
$string['configdesc_proxy'] = 'Proxy: z.B. proxy.private.xxx.de';
$string['configlabel_proxyport'] = 'Proxyport';
$string['configdesc_proxyport'] = 'Proxyport: z.B. 80';
$string['configlabel_curl_url'] = 'get_course_evaluations url';
$string['configdesc_curl_url'] = 'URL für get_course_evaluations.php';
$string['configlabel_curl_token'] = 'Token';
$string['configdesc_curl_token'] = 'Evaluations-Token';

$string['warning_evays_configuration_error'] = 'Fehler in der Konfiguration von Evasys!';
$string['warning_missing_configuration_error'] = 'Fehlende Konfiguration!';

$string['entrytext'] = '<strong>Schenken Sie uns 5 Minuten Ihrer Zeit, um die Kursqualität weiter zu verbessern?</strong></br></br>Klasse! Mit der Beantwortung von ein paar Fragen zu unserem Online-Studienmaterial tragen Sie zur Qualitätssicherung unserer Studiengänge bei. Selbstverständlich erfolgt die Befragung anonym.</br></br>Vielen Dank für Ihre Unterstützung.';
$string['footertext'] = 'Nur durch Ihre Mitarbeit können wir die Qualität verbessern. Selbstverständlich erfolgt die Befragung anonym.<br/><br/><strong>Vielen Dank!</strong>';
