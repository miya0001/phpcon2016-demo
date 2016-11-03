Feature: Form

  @javascript
  Scenario: Send message from contact form

    Given I am on "/contact"

    When I fill in the following:
      | your-name    | miya             |
      | your-email   | miya@example.com |
      | your-subject | Hello            |
      | your-message | こんにちは！       |
    And I press "Send"
    And I wait for 3 seconds

    Then I should see "Thank you for your message. It has been sent."
