<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

/**
 * Font list normalisation for Tiny CCEAD font family.
 *
 * @package     tiny_cceadfontfamily
 * @copyright   2026 CCEAD
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tiny_cceadfontfamily;

defined('MOODLE_INTERNAL') || die();

/**
 * Normalises the administrator supplied font list.
 */
final class fontlist {
    /**
     * Split on any common line ending, trim entries, and remove duplicates.
     *
     * @param string $value Raw setting value.
     * @return array<int, string> Normalised font names.
     */
    public static function normalise(string $value): array {
        $entries = preg_split('/\r\n|\r|\n/', $value) ?: [];
        $entries = array_map('trim', $entries);
        $entries = array_filter($entries, static fn(string $entry): bool => $entry !== '');
        return array_values(array_unique($entries));
    }
}
