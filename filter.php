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
 * Used to display Leeloo LXP content plugins anywhere in Moodle contents.
 *
 * @package    filter_leeloolxp_ai
 * @copyright  filter_leeloolxp_ai
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Class filter_leeloolxp_ai
 */
class filter_leeloolxp_ai extends moodle_text_filter {

    protected function convertAsterisksToBold($text) {
        // Regular expression to find text between two asterisks
        $pattern = '/\*\*(.*?)\*\*/';

        // Replacement pattern to convert matched text to bold
        $replacement = '<strong>$1</strong>';

        // Replace and return the modified text
        return preg_replace($pattern, $replacement, $text);
    }

    protected function connect_leeloo_db() {
        $extdbconfig = new stdClass();
        $extdbconfig->dbtype    = 'mysqli';
        $extdbconfig->dbhost    = get_config('filter_leeloolxp_ai')->lx_db_host;
        $extdbconfig->dbname    = get_config('filter_leeloolxp_ai')->lx_db_name;
        $extdbconfig->dbuser    = get_config('filter_leeloolxp_ai')->lx_db_user;
        $extdbconfig->dbpass    = get_config('filter_leeloolxp_ai')->lx_db_pass;
        $extdbconfig->dbport    = get_config('filter_leeloolxp_ai')->lx_db_port;

        $extdb = moodle_database::get_driver_instance($extdbconfig->dbtype, 'native');
        $extdb->connect($extdbconfig->dbhost, $extdbconfig->dbuser, $extdbconfig->dbpass, $extdbconfig->dbname, false, null);

        return $extdb;
    }

    /**
     * Apply the filter to the text and display Leeloo LXP content plugins instead of shortcode.
     *
     * @param string $text to be processed by the text
     * @param array $options filter options
     * @return string text after processing
     * @throws coding_exception
     * @throws dml_exception
     * @throws moodle_exception
     * @see filter_manager::apply_filter_chain()
     */
    public function filter($text, array $options = array()) {
        if (strpos($text, '{{LEELOOLXP_AI_DATA}}') === false) {
            return $text;
        }

        global $DB, $PAGE;

        $cmid = null;
        $context = $PAGE->context;

        if ($context->contextlevel == CONTEXT_MODULE) {
            $cmid = $context->instanceid;
            $cm = get_coursemodule_from_id('', $cmid, 0, false, MUST_EXIST);

            if ($cm && $cm->modname == 'assign') {
                $section_id = $cm->section;

                $extdb = $this->connect_leeloo_db();
                $sql = "SELECT * FROM lms_assignments_metadata WHERE assignmentid = ?";
                $data = $extdb->get_records_sql($sql, array($cmid));

                $reformattedData = [];
                foreach ($data as $item) {
                    if (isset($item->datatype)) {
                        $decodedJson = json_decode($item->data, true);

                        if (json_last_error() === JSON_ERROR_NONE) {
                            // If it's JSON, use the decoded array
                            $reformattedData[$item->datatype] = $decodedJson;
                        } else {
                            // If it's not JSON, keep it as a string
                            $reformattedData[$item->datatype] = $item->data;
                        }
                    }
                }

                $course = get_course($cm->course);
                $course_fullname = $course->fullname;

                $section_name = '';
                $section_summary = '';

                $sql = "SELECT name, summary FROM {course_sections} WHERE id = ?";
                $section_record = $DB->get_record_sql($sql, array($section_id));

                if ($section_record) {
                    $section_name = format_string($section_record->name);
                    $section_summary = format_text($section_record->summary);
                }

                $dataForTemplate = [
                    'convertToBold' => function ($text) {
                        return $this->convertAsterisksToBold($text);
                    },
                    'COURSE_LONG' => $course_fullname ?? '',
                    'UNIT_NAME' => $section_name ?? '',
                    'UNIT_SUMMARY' => $section_summary ?? '',
                    'INSTRUCTIONS' => $reformattedData['instructions'] ?? '',
                    'UNIT_CODE' => $reformattedData['unitcode'] ?? '',
                    'CONCEPTOS' => $reformattedData['concepts'] ?? '',
                    'ESCENARIO' => $reformattedData['escenario'] ?? '',
                    'STEPS' => $reformattedData['pasos_de_investigacion'] ?? '',
                    'Recommendations' => $reformattedData['recomendaciones'] ?? '',
                    'OBJETIVO' => $reformattedData['objetivo'] ?? '',
                    'Reflections' => $reformattedData['auto_revision_final'] ?? ''
                ];

                // Load the template and pass the data
                $content = $this->loadTemplate('template_assignment.php', $dataForTemplate);

                $text = str_replace('{{LEELOOLXP_AI_DATA}}', $content, $text);

                $extdb->dispose();

                return $text;
            }
        }

        return $text;
    }

    protected function loadTemplate($templateFileName, $data) {
        extract($data);
        ob_start();
        include($templateFileName);
        return ob_get_clean();
    }
}
