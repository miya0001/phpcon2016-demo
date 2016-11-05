# Behatを使ってWordPressの構成のテストを自動化する

このリポジトリは PHPカンファレンス 2016 で発表した内容のデモのソースです。

スライドはこちら。

https://speakerdeck.com/miya0001/behatwoshi-tutewordpressfalsegou-cheng-wotesutosuru

## インストール方法

```
$ git clone git@github.com:miya0001/phpcon2016-demo.git
$ cd phpcon2016-demo
$ npm install
$ npm run init
```

## 設定

1. `behat.yml` の `base_url` の値をテストしたい対象のホスト名で修正する。
2. `roles` > `administrator` 以下の `username` と `password` の値を実際のWordPressユーザーアカウントに合わせて修正する。

以下は、全体のサンプル。

```
default:
  suites:
    default:
      paths:
        - %paths.base%/features
      contexts:
        - FeatureContext
        - VCCW\Behat\Mink\WordPressExtension\Context\WordPressContext
        - Behat\MinkExtension\Context\MinkContext
  extensions:
    VCCW\Behat\Mink\WordPressExtension:
      roles:
        administrator:
          username: admin
          password: admin
    Behat\MinkExtension:
      base_url: http://vccw.dev
      sessions:
        default:
          selenium2:
            wd_host: http://127.0.0.1:4444/wd/hub
```

### 設定の暗号化

たとえば Travis CI 等でテストを行いたいときに、上の例のようにパスワードを直接設定ファイルに書く方法はパスワードの漏洩を招いてしまいます。

その場合は以下のように設定を環境変数 `$BEHAT_PARAMS` から取得するようにして、Travis CI で暗号化してください。

https://docs.travis-ci.com/user/encryption-keys/

環境変数 `$BEHAT_PARAMS` の例:

```
$ echo $BEHAT_PARAMS | jq .
{
  "extensions": {
    "VCCW\\Behat\\Mink\\WordPressExtension": {
      "roles": {
        "administrator": {
          "username": "admin",
          "password": "admin"
        }
      }
    },
    "Behat\\MinkExtension": {
      "base_url": "https://example.com"
    }
  }
}
```

環境変数で設定を行う際には、`behat.yml` 側の重複する部分を以下のように消してください。

`behat.yml` の例

```
default:
  suites:
    default:
      paths:
        - %paths.base%/features
      contexts:
        - FeatureContext
        - VCCW\Behat\Mink\WordPressExtension\Context\WordPressContext
        - Behat\MinkExtension\Context\MinkContext
  extensions:
    VCCW\Behat\Mink\WordPressExtension:
      roles:
        administrator:
          username: admin
          password: admin
    Behat\MinkExtension:
      base_url: http://vccw.dev
      sessions:
        default:
          selenium2:
            wd_host: http://127.0.0.1:4444/wd/hub
```


## テストを書く

テスト用のファイルは `features/` ディレクトリ以下に `*.feature` という拡張子で設置する。
複数のファイルがある場合はすべてのファイルが自動的に実行されます。

### テストの例:

このテストの例では、WordPressにログインして、管理バーが表示されているか？モバイルではテキストが非表示になっているか？などをテストしています。

```
Feature: 一般的なテスト

  @javascript
  Scenario: ログインとログアウトのテスト

    Given the screen size is 1440x900

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
```

サンプルとして `example-feature/` ディレクトリ以下にいくつか置いてありますので、そちらも見てください。

https://github.com/miya0001/phpcon2016-demo/tree/master/example-features

### テストの文法

以下のコマンドで Context (文法？)のリストを見ることができます。

```
$ bin/behat -di --lang=en
```

出力サンプル:

```
$ bin/behat -di --lang=en
default | [Then|*] I should be logged in
        | Return exception if user haven't logged in
        | Example: Then I should have logged in
        | at `VCCW\Behat\Mink\WordPressExtension\Context\WordPressContext::i_have_loggend_in()`

default | [Given|*] /^I login as "(?P<username>(?:[^"]|\\")*)" with password "(?P<password>(?:[^"]|\\")*)"$/
        | Login with username and password.
        | Example: Given I login as "admin" width password "admin"
        | at `VCCW\Behat\Mink\WordPressExtension\Context\WordPressContext::login_as_user_password()`

default | [Given|*] /^I login as the "(?P<role>[a-zA-Z]*)" role$/
        | Login as the role like "administrator", It should be defined in the `behat.yml`.
        | Example: Given I login as the "([^"]*)" role
        | at `VCCW\Behat\Mink\WordPressExtension\Context\WordPressContext::login_as_the_role()`

default | [When|*] /^I hover over the "(?P<selector>[^"]*)" element$/
        | The mouseover over the specific element.
        | Example: I hover over the ".site-title a" element
        | at `VCCW\Behat\Mink\WordPressExtension\Context\WordPressContext::hover_over_the_element()`
```

## テストを実行する

以下のコマンドを実行してください。

### PhantomJS をバックグラウンドで実行

```
$ npm start
```

### テストを実行

```
$ bin/behat
```

または

```
$ npm test
```

### PhantomJSを停止

```
$ npm stop
```

`npm stop` を忘れてもパソコンの再起動等で停止しますが、気持ちが悪ければ逐次とめてください。
