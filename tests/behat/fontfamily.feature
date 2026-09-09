@editor @editor_tiny @tiny @tiny_cceadfontfamily @javascript
Feature: Tiny CCEAD font family
  In order to format content consistently
  As a user with the CCEAD font family capability
  I need to apply configured font families without losing other formatting

  Background:
    Given I log in as "admin"
    And the following config values are set as admin:
      | fonts | Arial | tiny_cceadfontfamily |
    And I open my profile in edit mode
    And I set the field "Description" to "<p><span style='color: red; font-size: 14pt'>First text</span> and <strong>second text</strong></p>"

  @javascript
  Scenario: Apply a family to a selection and preserve existing styles after save and reopen
    When I select the "p" element in position "0" of the "Description" TinyMCE editor
    And I click on the "Format > Font family" menu item for the "Description" TinyMCE editor
    And I click on "Arial" "menuitem"
    Then the field "Description" matches expression "@font-family:\s*Arial@"
    And the field "Description" matches expression "@color:\s*red@"
    And the field "Description" matches expression "@font-size:\s*14pt@"
    And I click on "Update profile" "button"
    And I open my profile in edit mode
    Then the field "Description" matches expression "@font-family:\s*Arial@"

  @javascript
  Scenario: Apply font size then family and preserve both after save and reopen
    When I select the "p" element in position "0" of the "Description" TinyMCE editor
    And I click on the "Format > Font size" menu item for the "Description" TinyMCE editor
    And I click on "14 pt" "menuitem"
    And I select the "p" element in position "0" of the "Description" TinyMCE editor
    And I click on the "Format > Font family" menu item for the "Description" TinyMCE editor
    And I click on "Arial" "menuitem"
    Then the field "Description" matches expression "@font-size:\s*14pt@"
    And the field "Description" matches expression "@font-family:\s*Arial@"
    And I click on "Update profile" "button"
    And I open my profile in edit mode
    Then the field "Description" matches expression "@font-size:\s*14pt@"
    And the field "Description" matches expression "@font-family:\s*Arial@"

  @javascript
  Scenario: Apply family then font size and preserve both after save and reopen
    When I select the "p" element in position "0" of the "Description" TinyMCE editor
    And I click on the "Format > Font family" menu item for the "Description" TinyMCE editor
    And I click on "Arial" "menuitem"
    And I select the "p" element in position "0" of the "Description" TinyMCE editor
    And I click on the "Format > Font size" menu item for the "Description" TinyMCE editor
    And I click on "14 pt" "menuitem"
    Then the field "Description" matches expression "@font-family:\s*Arial@"
    And the field "Description" matches expression "@font-size:\s*14pt@"
    And I click on "Update profile" "button"
    And I open my profile in edit mode
    Then the field "Description" matches expression "@font-family:\s*Arial@"
    And the field "Description" matches expression "@font-size:\s*14pt@"

  @javascript
  Scenario: Apply both styles to a partial selection and preserve existing styles
    When I select a partial inline element in the "Description" TinyMCE editor
    And I click on the "Format > Font family" menu item for the "Description" TinyMCE editor
    And I click on "Arial" "menuitem"
    And I click on the "Format > Font size" menu item for the "Description" TinyMCE editor
    And I click on "14 pt" "menuitem"
    Then the field "Description" matches expression "@font-family:\s*Arial@"
    And the field "Description" matches expression "@font-size:\s*14pt@"
    And the field "Description" matches expression "@color:\s*red@"
    And I click on "Update profile" "button"
    And I open my profile in edit mode
    Then the field "Description" matches expression "@font-family:\s*Arial@"
    And the field "Description" matches expression "@font-size:\s*14pt@"

  @javascript
  Scenario: Apply family across inline elements and undo and redo the change
    When I select across inline elements in the "Description" TinyMCE editor
    And I click on the "Format > Font family" menu item for the "Description" TinyMCE editor
    And I click on "Arial" "menuitem"
    Then the field "Description" matches expression "@font-family:\s*Arial@"
    And I undo the last change in the "Description" TinyMCE editor
    Then the field "Description" does not match expression "@font-family:\s*Arial@"
    And I redo the last change in the "Description" TinyMCE editor
    Then the field "Description" matches expression "@font-family:\s*Arial@"
    And the field "Description" matches expression "@color:\s*red@"
    And the field "Description" matches expression "@font-size:\s*14pt@"
    And I click on "Update profile" "button"
    And I open my profile in edit mode
    Then the field "Description" matches expression "@font-family:\s*Arial@"

  @javascript
  Scenario: A user without the capability cannot use the control
    Given the following "courses" exist:
      | fullname | shortname | format |
      | Course 1 | C1        | topics |
    And the following "roles" exist:
      | name           | shortname | description         | archetype      |
      | Limited editor | limited    | Limited permissions | editingteacher |
    Given the following "users" exist:
      | username | firstname | lastname | email |
      | limited  | Limited   | User    | limited@example.com |
    And the following "course enrolments" exist:
      | user    | course | role    |
      | limited | C1     | limited |
    And the following "activities" exist:
      | activity | name      | intro     | introformat | course | content     | contentformat | idnumber |
      | page     | PageName1 | PageDesc1 | 1           | C1     | PageContent | 1             | 1        |
    And the following "permission overrides" exist:
      | capability                 | permission | role  | contextlevel | reference |
      | tiny/cceadfontfamily:use   | Prohibit   | limited | Course       | C1        |
    When I log in as "limited"
    And I am on the "PageName1" "page activity" page
    And I navigate to "Settings" in current page administration
    Then "Font family" button should not exist in the "Description" TinyMCE editor
