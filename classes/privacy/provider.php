<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

/**
 * Privacy API implementation for Tiny CCEAD font family.
 *
 * @package     tiny_cceadfontfamily
 * @category    privacy
 * @copyright   2026 CCEAD
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tiny_cceadfontfamily\privacy;

/**
 * Provider for a plugin that stores no personal data.
 */
class provider implements \core_privacy\local\metadata\null_provider {
    /** @return string */
    public static function get_reason(): string {
        return 'privacy:metadata';
    }
}
