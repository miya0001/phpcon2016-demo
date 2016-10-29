Feature: WordPress Admin

  Scenario: Showing the toppage

    When I am on "/"
    Then I should see "Welcome to the VCCW"

  @javascript
  Scenario: Showing the toppage with login

    Given The screen size is 1440x900
    And I am on "/wp-login.php"
    And I fill in "user_login" with "admin"
    And I fill in "user_pass" with "admin"
    And I press "wp-submit"

    When I am on "/"
    And I Wait for the page to be loaded
    Then I should see "Howdy, admin"

  @javascript
  Scenario: Login into the WordPress as admin with PC
    Given The screen size is 1440x900
    And I am on "/wp-login.php"
    And I fill in "user_login" with "admin"
    And I fill in "user_pass" with "admin"
    And I press "wp-submit"

    When I am on "/wp-admin/"
    And I Wait for the page to be loaded
    Then I should see "Dashboard"
    And I should see "Collapse menu"

    When I am on "/wp-admin/plugins.php"
    Then I should see "Plugins"
    And I should see "Debug Bar"

    When I am on "/wp-admin/customize.php"
    Then I should see "Site Identity"

  @javascript
  Scenario: Login into the WordPress as admin with mobile
    Given The screen size is 320x480
    And I am on "/wp-admin/"

    When I fill in "user_login" with "admin"
    And I fill in "user_pass" with "admin"
    And I press "wp-submit"

    Then I should see "Dashboard"
    And I should not see "Collapse menu"
