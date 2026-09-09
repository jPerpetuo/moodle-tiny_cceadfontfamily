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

// NOTE: no MOODLE_INTERNAL test here, this file may be required by Behat before including /config.php.
require_once(__DIR__ . '/../../../../../../behat/behat_base.php');
require_once(__DIR__ . '/../../../../tests/behat/editor_tiny_helpers.php');

/**
 * Additional selection steps for Tiny CCEAD font family integration tests.
 *
 * @package     tiny_cceadfontfamily
 * @copyright   2026 CCEAD
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class behat_tiny_cceadfontfamily extends behat_base {
    use editor_tiny_helpers;

    /**
     * Select all but the final character in the first matching inline element.
     *
     * @When I select a partial inline element in the "Description" TinyMCE editor
     */
    public function select_partial_inline_element(): void {
        $this->require_tiny_tags();
        $editor = $this->get_textarea_for_locator('Description');
        $editorid = $editor->getAttribute('id');
        $this->execute_javascript_for_editor($editorid, <<<'JS'
            const element = instance.dom.select('span')[0];
            const text = element.firstChild;
            const range = instance.dom.createRng();
            range.setStart(text, 0);
            range.setEnd(text, Math.max(1, text.length - 1));
            instance.selection.setRng(range);
            JS);
    }

    /**
     * Select text spanning the first two inline elements in the editor.
     *
     * @When I select across inline elements in the "Description" TinyMCE editor
     */
    public function select_across_inline_elements(): void {
        $this->require_tiny_tags();
        $editor = $this->get_textarea_for_locator('Description');
        $editorid = $editor->getAttribute('id');
        $this->execute_javascript_for_editor($editorid, <<<'JS'
            const first = instance.dom.select('span')[0];
            const second = instance.dom.select('strong')[0];
            const range = instance.dom.createRng();
            range.setStart(first.firstChild, 0);
            range.setEnd(second.firstChild, second.firstChild.length);
            instance.selection.setRng(range);
            JS);
    }
}
