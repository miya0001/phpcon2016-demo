Feature: WordPress Admin

  Scenario: Showing the toppage

    When I am on "/"
    Then I should see "Welcome to the VCCW"

  @javascript
  Scenario: Showing the toppage with login

    Given The screen size is 1440x900
    And I login as "admin" with password "admin"

    When I am on "/"
    And I wait for 3 second
    Then I should see "Howdy,"

    When I logout
    And I wait for 3 second
    Then I should not see "Howdy,"

  @javascript
  Scenario: Login into the WordPress as admin with PC
    Given The screen size is 1440x900
    And I login as "admin" with password "admin"

    When I am on "/wp-admin/"
    And I wait for 3 second
    Then I should see "Dashboard"
    And I should see "Collapse menu"

    # When I click "collapse-menu"
    # And I should not see "Collapse menu"

    When I am on "/wp-admin/plugins.php"
    Then I should see "Plugins"
    And I should see "Debug Bar"

    When I am on "/wp-admin/customize.php"
    Then I should see "Site Identity"

  @javascript
  Scenario: Login into the WordPress as admin with mobile
    Given The screen size is 320x480
    And I am on "/wp-admin/"
    And I login as "admin" with password "admin"

    Then I should see "Dashboard"
    And I should not see "Collapse menu"
