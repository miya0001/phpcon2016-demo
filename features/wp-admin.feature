Feature: WordPress Admin

  Scenario: Searching for a page that does exist

    When I am on "/"

    Then I should see "Welcome to the VCCW"

  Scenario: Login into the WordPress as admin
    Given I am on "/wp-admin/"

    When I fill in "user_login" with "admin"
    And I fill in "user_pass" with "admin"
    And I press "wp-submit"

    Then I should see "Dashboard"

  Scenario: Go to the plugin page
    Given I am on "/wp-admin/plugins.php"
    And I fill in "user_login" with "admin"
    And I fill in "user_pass" with "admin"
    And I press "wp-submit"

    Then I should see "Plugins"
    And I should see "Debug Bar"

  Scenario: Go to the plugin page
    Given I am on "/wp-admin/customize.php"
    And I fill in "user_login" with "admin"
    And I fill in "user_pass" with "admin"
    And I press "wp-submit"

    Then I should see "Site Identity"
