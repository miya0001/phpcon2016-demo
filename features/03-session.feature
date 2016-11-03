Feature: Session

  @javascript
  Scenario: PC and Mobile

    Given I login as the "administrator" role
    And I am on "/wp-admin/"

    When I am on "/"
    Then I should see "Welcome"

    When I am on "/wp-admin/plugins.php"
    Then I should see "Contact Form 7"
