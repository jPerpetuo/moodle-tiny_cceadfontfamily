// This file is part of Moodle - http://moodle.org/

/**
 * TinyMCE configuration for Tiny CCEAD font family.
 *
 * @module      tiny_cceadfontfamily/configuration
 * @copyright   2026 CCEAD
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import {addMenubarItem, addToolbarButtons} from 'editor_tiny/utils';
import {fontfamilyButtonName, fontfamilyMenuItemName} from './common';

export const configure = (instanceConfig) => ({
    toolbar: addToolbarButtons(instanceConfig.toolbar, 'formatting', [fontfamilyButtonName]),
    menu: addMenubarItem(instanceConfig.menu, 'format', fontfamilyMenuItemName),
});
