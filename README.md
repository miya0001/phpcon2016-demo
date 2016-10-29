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
    Given The screen size is 1440x900         # FeatureContext::set_window_size()
    And I am on "/wp-admin/"                  # Behat\MinkExtension\Context\MinkContext::visit()
    And I fill in "user_login" with "admin"   # Behat\MinkExtension\Context\MinkContext::fillField()
    And I fill in "user_pass" with "admin"    # Behat\MinkExtension\Context\MinkContext::fillField()
    And I press "wp-submit"                   # Behat\MinkExtension\Context\MinkContext::pressButton()
    When I am on "/wp-admin/"                 # Behat\MinkExtension\Context\MinkContext::visit()
    And I Wait for the page to be loaded      # FeatureContext::waitForThePageToBeLoaded()
    Then I should see "Dashboard"             # Behat\MinkExtension\Context\MinkContext::assertPageContainsText()
    And I should see "Collapse menu"          # Behat\MinkExtension\Context\MinkContext::assertPageContainsText()
    When I am on "/wp-admin/plugins.php"      # Behat\MinkExtension\Context\MinkContext::visit()
    Then I should see "Plugins"               # Behat\MinkExtension\Context\MinkContext::assertPageContainsText()
    And I should see "Debug Bar"              # Behat\MinkExtension\Context\MinkContext::assertPageContainsText()
    When I am on "/wp-admin/customize.php"    # Behat\MinkExtension\Context\MinkContext::visit()
    Then I should see "Site Identity"         # Behat\MinkExtension\Context\MinkContext::assertPageContainsText()

  Scenario: Login into the WordPress as admin # features/wp-admin.feature:28
    Given The screen size is 320x480          # FeatureContext::set_window_size()
    And I am on "/wp-admin/"                  # Behat\MinkExtension\Context\MinkContext::visit()
    When I fill in "user_login" with "admin"  # Behat\MinkExtension\Context\MinkContext::fillField()
    And I fill in "user_pass" with "admin"    # Behat\MinkExtension\Context\MinkContext::fillField()
    And I press "wp-submit"                   # Behat\MinkExtension\Context\MinkContext::pressButton()
    Then I should see "Dashboard"             # Behat\MinkExtension\Context\MinkContext::assertPageContainsText()
    And I should not see "Collapse menu"      # Behat\MinkExtension\Context\MinkContext::assertPageNotContainsText()

3 個のシナリオ (3 個成功)
23 個のステップ (23 個成功)
0m5.63s (9.30Mb)
```
