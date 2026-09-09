<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

declare(strict_types=1);

namespace tiny_cceadfontfamily;

use advanced_testcase;

/**
 * Unit tests for Tiny CCEAD font family plugin information.
 *
 * @package     tiny_cceadfontfamily
 * @copyright   2026 CCEAD
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class plugininfo_test extends advanced_testcase {
    public function test_is_enabled_requires_capability(): void {
        $this->resetAfterTest(true);
        $user = $this->getDataGenerator()->create_user();
        $context = \context_system::instance();
        $this->setUser($user);
        $this->assertTrue(plugininfo::is_enabled($context, [], []));
        $this->setGuestUser();
        $this->assertFalse(plugininfo::is_enabled($context, [], []));
    }

    public function test_configuration_normalises_line_endings_spaces_and_duplicates(): void {
        set_config('fonts', " Arial \r\n\rVerdana\nArial\n \n", 'tiny_cceadfontfamily');
        $this->assertSame(
            ['Arial', 'Verdana'],
            plugininfo::get_plugin_configuration_for_context(\context_system::instance(), [], [])['fonts']
        );
    }

    public function test_configuration_supports_empty_and_single_item_lists(): void {
        set_config('fonts', '', 'tiny_cceadfontfamily');
        $this->assertSame([], plugininfo::get_plugin_configuration_for_context(\context_system::instance(), [], [])['fonts']);
        set_config('fonts', ' Georgia ', 'tiny_cceadfontfamily');
        $this->assertSame(['Georgia'], plugininfo::get_plugin_configuration_for_context(\context_system::instance(), [], [])['fonts']);
    }

    public function test_available_controls_are_registered_once(): void {
        $expected = ['tiny_cceadfontfamily/plugin'];
        $this->assertSame($expected, plugininfo::get_available_buttons());
        $this->assertSame($expected, plugininfo::get_available_menuitems());
    }
}
