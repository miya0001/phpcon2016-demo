Feature: Search
  In order to see a word definition
  As a website user
  I need to be able to search for a word

  Scenario: Searching for a page that does exist
    When I am on "/"
    Then I should see "Welcome to the VCCW"

  Scenario: Login into the WordPress as admin
    Given I am on "/wp-admin/"
    When I fill in "user_login" with "admin"
    And I fill in "user_pass" with "admin"
    And I press "wp-submit"
    Then I should see "Dashboard"
