Feature: Admin bar

  Scenario: Showing the Homepage

    When I am on "/"
    Then I should see "Welcome to the VCCW"
    And I should see "Welcome to the VCCW" in the "h1.site-title" element

  @javascript
  Scenario: Showing the Homepage with login

    Given The screen size is 1440x900
    And I login as "admin" with password "admin"

    When I am on "/"
    And I wait the "#wpadminbar" element be loaded
    Then I should see "Howdy,"

    When I logout
    Then I should not see "Howdy,"
