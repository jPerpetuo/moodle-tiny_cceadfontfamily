# Tiny CCEAD font family

This Moodle TinyMCE subplugin provides an administrator-configured list of font families. It is independent of `tiny_fontfamily` and is intended for institutional use under the component `tiny_cceadfontfamily`.

## Installation

Place this directory at `<moodleroot>/lib/editor/tiny/plugins/cceadfontfamily`, then complete the Moodle upgrade as an administrator. Add the `Font family` control to the Tiny editor toolbar or Format menu in the Tiny editor administration settings.

The administrator setting accepts one family per line. Unix, Windows, and old Mac line endings are accepted. Leading and trailing whitespace, blank lines, and exact duplicate entries are removed. An empty list disables the control; a single configured family remains available as one menu choice.

## Compatibility

The plugin declares Moodle 5.1 and 5.2 support and requires Moodle API level `2025092600`. The CI workflow tests Moodle 5.1 with PHP 8.2 and 8.4, Moodle 5.2 with PHP 8.3 and 8.4, PostgreSQL 16, and MariaDB 11. These are the combinations declared in the workflow. Local execution requires a configured Moodle development installation.

## Behaviour and limitations

The plugin applies TinyMCE's `fontname` formatter to the current selection. TinyMCE handles partial selections, selections crossing inline elements, undo/redo, and preservation of unrelated inline styles such as font size and colour. The selected family must be present in the configured list. The plugin does not install fonts or guarantee that a selected font exists on the user's device.

The automated tests cover capability checks, configuration normalisation, the formatter contract, and Behat flows for style preservation, partial selections, undo/redo, and persistence. The CI workflow optionally installs the private companion `tiny_cceadfontsize` plugin when the repository secret `CCEADFONTSIZE_READ_TOKEN` is configured with read-only access to that repository. Without the secret, this plugin is still installed and tested independently. Full browser homologation should also cover the target institution's Moodle installation.

The joint homologation scenarios are:

1. Apply a font size, then apply a font family to the same selection. Confirm that both `font-size` and `font-family` remain in the saved HTML after closing and reopening the editor.
2. Apply a font family, then apply a font size to the same selection. Confirm the same persistence and preservation result.
3. Repeat both orders with a partial selection and with a selection crossing two inline elements that already have different colour or weight styles. The Behat suite covers these cases when the optional companion checkout is enabled.

These scenarios require `tiny_cceadfontsize` and `tiny_cceadfontfamily` installed together. The two plugins do not share settings, capabilities, or JavaScript state.

## Development checks

The workflow uses Moodle Plugin CI for PHP lint, PHPMD, PHPCS, PHPDoc, validation, savepoint checks, Grunt, PHPUnit, and Behat. AMD build artifacts must be generated with Moodle's standard Grunt workflow before packaging a source checkout.

## Distribution

The distributable archive must contain this plugin in a single top-level directory named `cceadfontfamily`. Include the generated files under `amd/build`, and exclude the repository metadata, local logs, temporary files, and development environment files. Install the archive at `<moodleroot>/lib/editor/tiny/plugins/cceadfontfamily`.

The repository is maintained privately. A version tag and a GitHub release may be used for institutional distribution without publishing the plugin to the Moodle Marketplace.

## License

This plugin is licensed under the GNU General Public License, version 3 or later. It is derived from Moodle's `tiny_fontfamily` plugin, whose GPL attribution is retained in the accompanying `LICENSE` file.
