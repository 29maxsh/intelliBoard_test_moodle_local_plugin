<?php

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
 * External Web Service Template
 *
 * @package    localwstemplate
 * @copyright  2011 Moodle Pty Ltd (http://moodle.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once($CFG->libdir . "/externallib.php");

class local_wstemplate_external extends external_api {

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_users_parameters() {
        return new external_function_parameters(
                array('param' => new external_value(PARAM_TEXT, 'param', VALUE_DEFAULT, 'param'))
        );
    }

    /**
     * Returns users
     * @return string users
     */
    public static function get_users() {
        $users = get_users(true, '', false, null, 'firstname ASC', '', '', '', '', 'id, username, firstname, lastname, email');
        return json_encode($users);
    }

    /**
     * Returns description of method result value
     * @return external_description
     */
    public static function get_users_returns() {
        return new external_value(PARAM_TEXT, 'list of users');
    }

    public static function get_courses_parameters() {
        return new external_function_parameters(
            array('param' => new external_value(PARAM_TEXT, 'param', VALUE_DEFAULT, 'param'))
        );
    }

    public static function get_courses() {
        $courses = get_courses();
        return json_encode($courses);
    }

    public static function get_courses_returns() {
        return new external_value(PARAM_TEXT, 'list of courses');
    }

    public static function get_enrolled_users_parameters() {
        return new external_function_parameters(
            array('courseid' => new external_value(PARAM_INT, 'The course id', VALUE_DEFAULT, 1))
        );
    }

    public static function get_enrolled_users($courseid = 1) {
        $context = context_course::instance($courseid);
        $users = get_enrolled_users($context, '', 0, 'u.id, u.username, u.firstname, u.lastname, u.email');
        return json_encode($users);
    }

    public static function get_enrolled_users_returns() {
        return new external_value(PARAM_TEXT, 'list of enrolled users');
    }

}
