@editor @editor_tiny @tiny @tiny_cceadfontfamily @javascript
Feature: Tiny CCEAD font family
  In order to format content consistently
  As a user with the CCEAD font family capability
  I need to apply configured font families without losing other formatting

  Background:
    Given I log in as "admin"
    And the following config values are set as admin:
      | fonts | Arial\nGeorgia\n | tiny_cceadfontfamily |
    And I open my profile in edit mode
    And I set the field "Description" to "<p><span style='color: red; font-size: 14pt'>First text</span> and <strong>second text</strong></p>"

  @javascript
  Scenario: Apply a family to a selection and preserve existing styles after save and reopen
    When I select the "p" element in position "0" of the "Description" TinyMCE editor
    And I click on the "Format > Font family" menu item for the "Description" TinyMCE editor
    And I click on the "Arial" menu item for the "Description" TinyMCE editor
    Then the field "Description" matches expression "@font-family:\s*Arial@"
    And the field "Description" matches expression "@color:\s*red@"
    And the field "Description" matches expression "@font-size:\s*14pt@"
    And I click on "Update profile" "button"
    And I open my profile in edit mode
    Then the field "Description" matches expression "@font-family:\s*Arial@"

  @javascript
  Scenario: A user without the capability cannot use the control
    Given the following "users" exist:
      | username | firstname | lastname | email |
      | limited  | Limited   | User    | limited@example.com |
    And the following "permission overrides" exist:
      | capability                 | permission | role  | contextlevel | reference |
      | tiny/cceadfontfamily:use   | Prohibit   | user  | System       |           |
    When I log in as "limited"
    And I open my profile in edit mode
    Then "Font family" button should not exist in the "Description" TinyMCE editor
