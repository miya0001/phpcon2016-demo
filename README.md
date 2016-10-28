# Behat and PhantomJS based E2E Testing for the WordPress.

## Getting Started

```
$ npm install
$ npm run init
```

## Run Tests

```
$ npm test
```

## Example

```
$ bin/behat
Feature: WordPress Admin

  Scenario: Searching for a page that does exist # features/wp-admin.feature:3
    When I am on "/"                             # Behat\MinkExtension\Context\MinkContext::visit()
    Then I should see "Welcome to the VCCW"      # Behat\MinkExtension\Context\MinkContext::assertPageContainsText()

  Scenario: Login into the WordPress as admin # features/wp-admin.feature:9
    Given I am on "/wp-admin/"                # Behat\MinkExtension\Context\MinkContext::visit()
    When I fill in "user_login" with "admin"  # Behat\MinkExtension\Context\MinkContext::fillField()
    And I fill in "user_pass" with "admin"    # Behat\MinkExtension\Context\MinkContext::fillField()
    And I press "wp-submit"                   # Behat\MinkExtension\Context\MinkContext::pressButton()
    Then I should see "Dashboard"             # Behat\MinkExtension\Context\MinkContext::assertPageContainsText()
    And I should see "Dashboard"              # Behat\MinkExtension\Context\MinkContext::assertPageContainsText()

  Scenario: Go to the plugin page           # features/wp-admin.feature:19
    Given I am on "/wp-admin/plugins.php"   # Behat\MinkExtension\Context\MinkContext::visit()
    And I fill in "user_login" with "admin" # Behat\MinkExtension\Context\MinkContext::fillField()
    And I fill in "user_pass" with "admin"  # Behat\MinkExtension\Context\MinkContext::fillField()
    And I press "wp-submit"                 # Behat\MinkExtension\Context\MinkContext::pressButton()
    Then I should see "Plugins"             # Behat\MinkExtension\Context\MinkContext::assertPageContainsText()
    And I should see "Debug Bar"            # Behat\MinkExtension\Context\MinkContext::assertPageContainsText()

3 個のシナリオ (3 個成功)
14 個のステップ (14 個成功)
0m2.93s (8.96Mb)
```
