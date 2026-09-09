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
 * Tiny CCEAD font family plugin integration.
 *
 * @package     tiny_cceadfontfamily
 * @copyright   2026 CCEAD
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tiny_cceadfontfamily;

use context;
use editor_tiny\editor;
use editor_tiny\plugin;
use editor_tiny\plugin_with_buttons;
use editor_tiny\plugin_with_configuration;
use editor_tiny\plugin_with_menuitems;

/**
 * Tiny CCEAD font family plugin information.
 */
class plugininfo extends plugin implements plugin_with_buttons, plugin_with_configuration, plugin_with_menuitems {
    /**
     * Determine whether the plugin is enabled for the current context.
     *
     * @param context $context Context where the editor is being displayed.
     * @param array $options Editor options.
     * @param array $fpoptions File picker options.
     * @param editor|null $editor Editor instance, if available.
     * @return bool Whether the plugin is enabled.
     */
    public static function is_enabled(
        context $context,
        array $options,
        array $fpoptions,
        ?editor $editor = null
    ): bool {
        return has_capability('tiny/cceadfontfamily:use', $context);
    }

    /**
     * Return the buttons provided by this plugin.
     *
     * @return string[] Button identifiers.
     */
    public static function get_available_buttons(): array {
        return ['tiny_cceadfontfamily/plugin'];
    }

    /**
     * Return the menu items provided by this plugin.
     *
     * @return string[] Menu item identifiers.
     */
    public static function get_available_menuitems(): array {
        return ['tiny_cceadfontfamily/plugin'];
    }

    /**
     * Return the plugin configuration for the current context.
     *
     * @param context $context Context where the editor is being displayed.
     * @param array $options Editor options.
     * @param array $fpoptions File picker options.
     * @param editor|null $editor Editor instance, if available.
     * @return array<string, array<int, string>> Plugin configuration.
     */
    public static function get_plugin_configuration_for_context(
        context $context,
        array $options,
        array $fpoptions,
        ?editor $editor = null
    ): array {
        return ['fonts' => fontlist::normalise((string)get_config('tiny_cceadfontfamily', 'fonts'))];
    }
}
