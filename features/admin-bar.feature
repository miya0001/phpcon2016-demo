Feature: Admin bar

  Scenario: Showing the Homepage

    When I am on "/"
    Then I should see "Welcome to the VCCW"

  @javascript
  Scenario: Showing the Homepage with login

    Given The screen size is 1440x900
    And I login as "admin" with password "admin"

    When I am on "/"
    And I wait for 3 second
    Then I should see "Howdy,"

    When I logout
    And I wait for 3 second
    Then I should not see "Howdy,"
