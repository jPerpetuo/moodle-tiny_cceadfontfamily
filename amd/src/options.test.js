// This file is part of Moodle - http://moodle.org/

/**
 * Regression tests for Tiny CCEAD font family options.
 *
 * @module      tiny_cceadfontfamily/options
 * @copyright   2026 CCEAD
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/* eslint-env jest */

import {getFontList} from 'tiny_cceadfontfamily/options';

describe('Tiny CCEAD font family options', () => {
    it('normalises values received from the TinyMCE option processor', () => {
        const editor = {
            options: {
                get: () => [' Arial ', '', 'Arial', 'Georgia'],
            },
        };

        expect(getFontList(editor)).toEqual(['Arial', 'Georgia']);
    });

    it('returns an empty list for an invalid option value', () => {
        const editor = {options: {get: () => null}};
        expect(getFontList(editor)).toEqual([]);
    });
});
