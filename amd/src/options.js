// This file is part of Moodle - http://moodle.org/

/**
 * TinyMCE options for Tiny CCEAD font family.
 *
 * @module      tiny_cceadfontfamily/options
 * @copyright   2026 CCEAD
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import {getPluginOptionName} from 'editor_tiny/options';
import {pluginName} from './common';

const fonts = getPluginOptionName(pluginName, 'fonts');

export const register = (editor) => editor.options.register(fonts, {
    processor: 'Array',
    "default": [],
});

export const getFontList = (editor) => {
    const values = editor.options.get(fonts);
    if (!Array.isArray(values)) {
        return [];
    }
    return [...new Set(values.map((font) => String(font).trim()).filter(Boolean))];
};
