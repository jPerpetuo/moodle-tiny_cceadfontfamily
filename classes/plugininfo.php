<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

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
    /** @inheritDoc */
    public static function is_enabled(
        context $context,
        array $options,
        array $fpoptions,
        ?editor $editor = null
    ): bool {
        return has_capability('tiny/cceadfontfamily:use', $context);
    }

    /** @inheritDoc */
    public static function get_available_buttons(): array {
        return ['tiny_cceadfontfamily/plugin'];
    }

    /** @inheritDoc */
    public static function get_available_menuitems(): array {
        return ['tiny_cceadfontfamily/plugin'];
    }

    /** @inheritDoc */
    public static function get_plugin_configuration_for_context(
        context $context,
        array $options,
        array $fpoptions,
        ?editor $editor = null
    ): array {
        return ['fonts' => fontlist::normalise((string)get_config('tiny_cceadfontfamily', 'fonts'))];
    }
}
