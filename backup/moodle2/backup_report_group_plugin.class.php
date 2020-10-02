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
 * @package    moodlecore
 * @subpackage backup-moodle2
 * @copyright  2020 onwards Camille Tardy, University of Geneva
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();


/**
 * Provides the information to backup group quiz info
 */
class backup_report_group_plugin extends backup_report_plugin {

    /**
     * Returns the quiz report information to attach to quiz element
     */
    protected function define_quiz_plugin_structure() {
        // Define virtual plugin element, only backup report if conditions (get_include_condition) are met
        $plugin = $this->get_plugin_element(null, $this->get_include_condition(), 'include');

        // Create plugin container element with standard name
        $pluginwrapper = new backup_nested_element($this->get_recommended_name());

        // Add wrapper to plugin
        $plugin->add_child($pluginwrapper);

//TODO define backup datat and DB link

        // Set up quiz report's own structure and add to wrapper
        $groupquiz = new backup_nested_element('quiz_group', array('id'), array(
            'groupingid'));
        $pluginwrapper->add_child($groupquiz);

        // Use database to get source
        $groupquiz->set_source_table('quiz_group',
                array('quizid' => backup::VAR_QUIZID));


        return $plugin;
    }

   /**
    * Returns a condition for whether we include this report in the backup
    * or not. If no record with the quiz id exist, do not backup.
    * @return array Condition array
    */
   protected function get_include_condition() {
       global $DB;
       //TODO get quizid here.
       $quizid = 0;

       if ($DB->record_exists('quiz_group',
               array('quizid' => $quizid))) {
           $result = 'include';
       } else {
           $result = ;
       }
       return array('sqlparam' => $result);
   }


}
