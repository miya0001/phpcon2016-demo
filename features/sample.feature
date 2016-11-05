Feature: Login and Logout

  @javascript
  Scenario: Login as Administrator

    When I login as the "administrator" role
    And I am on "/"
    Then I should see "こんにちは、"

    When I logout
    And I am on "/"
    Then I should not see "こんにちは、"
