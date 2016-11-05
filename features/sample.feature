Feature: 一般的なテスト

  @javascript
  Scenario: ログインとログアウトのテスト

    When I login as the "administrator" role
    And I am on "/"
    Then I should see "こんにちは、"

    When I logout
    And I am on "/"
    Then I should not see "こんにちは、"

  @javascript
  Scenario: レスポンシブのテスト

    Given I login as the "administrator" role
    And I am on "/wp-admin/"

    When the screen size is 1440x900
    Then I should see "ダッシュボード" in the "#adminmenu" element

    When the screen size is 320x400
    Then I should not see "ダッシュボード" in the "#adminmenu" element
