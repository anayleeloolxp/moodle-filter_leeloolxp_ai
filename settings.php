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
 * Plugin administration pages are defined here.
 *
 * @package     filter_leeloolxp_ai
 * @copyright  2020 Leeloo LXP (https://leeloolxp.com)
 * @author     Leeloo LXP <info@leeloolxp.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {

    $settings = new admin_settingpage('filter_leeloolxp_ai', get_string('setting_title', 'filter_leeloolxp_ai'));

    $ADMIN->add('filterplugins', $settings);

    $settings->add(
        new admin_setting_configtext(
            'filter_leeloolxp_ai/lx_db_host',
            get_string('lx_db_host', 'filter_leeloolxp_ai'),
            get_string(
                'lx_db_host_desc',
                'filter_leeloolxp_ai'
            ),
            '',
            PARAM_TEXT
        )
    );

    $settings->add(
        new admin_setting_configtext(
            'filter_leeloolxp_ai/lx_db_user',
            get_string('lx_db_user', 'filter_leeloolxp_ai'),
            get_string(
                'lx_db_user_desc',
                'filter_leeloolxp_ai'
            ),
            '',
            PARAM_TEXT
        )
    );

    $settings->add(
        new admin_setting_configtext(
            'filter_leeloolxp_ai/lx_db_pass',
            get_string('lx_db_pass', 'filter_leeloolxp_ai'),
            get_string(
                'lx_db_pass_desc',
                'filter_leeloolxp_ai'
            ),
            '',
            PARAM_TEXT
        )
    );

    $settings->add(
        new admin_setting_configtext(
            'filter_leeloolxp_ai/lx_db_name',
            get_string('lx_db_name', 'filter_leeloolxp_ai'),
            get_string(
                'lx_db_name_desc',
                'filter_leeloolxp_ai'
            ),
            '',
            PARAM_TEXT
        )
    );

    $settings->add(
        new admin_setting_configtext(
            'filter_leeloolxp_ai/lx_db_port',
            get_string('lx_db_port', 'filter_leeloolxp_ai'),
            get_string(
                'lx_db_port_desc',
                'filter_leeloolxp_ai'
            ),
            '',
            PARAM_TEXT
        )
    );
}
