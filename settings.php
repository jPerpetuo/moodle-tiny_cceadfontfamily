<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

/**
 * Settings for Tiny CCEAD font family.
 *
 * @package     tiny_cceadfontfamily
 * @copyright   2026 CCEAD
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin = 'tiny_cceadfontfamily';
$settings = new admin_settingpage('tiny_cceadfontfamily_settings', new lang_string('settings', $plugin));

if ($ADMIN->fulltree) {
    $defaults = ['Arial', 'Verdana', 'Tahoma', 'Trebuchet MS', 'Times New Roman', 'Georgia', 'Garamond', 'Courier New'];
    $settings->add(new admin_setting_configtextarea(
        $plugin . '/fonts',
        new lang_string('fonts', $plugin),
        new lang_string('fonts_desc', $plugin),
        implode("\n", $defaults),
        PARAM_TEXT,
        80,
        10
    ));
}
