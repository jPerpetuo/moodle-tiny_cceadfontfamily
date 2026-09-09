// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

/**
 * Commands for Tiny CCEAD font family.
 *
 * @module      tiny_cceadfontfamily/commands
 * @copyright   2026 CCEAD
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import {getButtonImage} from 'editor_tiny/utils';
import {get_string as getString} from 'core/str';
import {getFontList} from './options';
import {component, fontfamilyButtonName, fontfamilyMenuItemName, icon} from './common';

/**
 * Apply a configured font family to the current selection.
 *
 * TinyMCE's fontname formatter handles partial and multi-element selections,
 * creates the required inline elements, preserves unrelated styles, and adds
 * the operation to the editor undo manager.
 *
 * @param {TinyMCE.editor} editor TinyMCE editor instance.
 * @param {string} family Configured font family.
 * @param {string[]} configuredFonts Configured list.
 * @returns {boolean} Whether a configured family was applied.
 */
export const applyFontFamily = (editor, family, configuredFonts) => {
    if (typeof family !== 'string' || !configuredFonts.includes(family)) {
        return false;
    }
    editor.formatter.apply('fontname', {value: family});
    return true;
};

/**
 * Get the asynchronous UI registration function.
 *
 * @returns {Promise<function(TinyMCE.editor): void>} UI registration function.
 */
export const getSetup = async() => {
    const [buttonTitle, menuItemTitle, buttonImage] = await Promise.all([
        getString('button_fontfamily', component),
        getString('menuitem_fontfamily', component),
        getButtonImage('icon', component),
    ]);

    return (editor) => {
        const fontList = getFontList(editor);
        if (!fontList.length) {
            return;
        }

        const submenuItems = fontList.map((family) => ({
            type: 'menuitem',
            text: family,
            onAction: () => applyFontFamily(editor, family, fontList),
        }));

        editor.ui.registry.addIcon(icon, buttonImage.html);
        editor.ui.registry.addMenuButton(fontfamilyButtonName, {
            icon,
            tooltip: buttonTitle,
            fetch: (callback) => callback(submenuItems),
        });
        editor.ui.registry.addNestedMenuItem(fontfamilyMenuItemName, {
            icon,
            text: menuItemTitle,
            getSubmenuItems: () => submenuItems,
        });
    };
};
