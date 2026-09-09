// This file is part of Moodle - http://moodle.org/

/**
 * Regression tests for Tiny CCEAD font family commands.
 *
 * @module      tiny_cceadfontfamily/commands
 * @copyright   2026 CCEAD
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/* eslint-env jest */

import {applyFontFamily} from 'tiny_cceadfontfamily/commands';

describe('Tiny CCEAD font family commands', () => {
    it('uses TinyMCE fontname formatter and leaves other styles to the formatter', () => {
        const apply = jest.fn();
        const editor = {formatter: {apply}};

        expect(applyFontFamily(editor, 'Arial', ['Arial', 'Georgia'])).toBe(true);
        expect(apply).toHaveBeenCalledWith('fontname', {value: 'Arial'});
    });

    it('rejects values that are not in the configured list', () => {
        const apply = jest.fn();
        const editor = {formatter: {apply}};

        expect(applyFontFamily(editor, 'Comic Sans MS', ['Arial'])).toBe(false);
        expect(apply).not.toHaveBeenCalled();
    });
});
