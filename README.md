# Behatを使ってWordPressの構成のテストを自動化する

このリポジトリは PHPカンファレンス 2016 で発表した内容のデモのソースです。

スライドはこちら。

git@github.com:miya0001/phpcon2016-demo.git

## インストール方法

```
$ git clone git@github.com:miya0001/phpcon2016-demo.git
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

## テストを書く

テスト用のファイルは `features/` ディレクトリ以下に `*.feature` という拡張子で設置する。
複数のファイルがある場合はすべてのファイルが自動的に実行されます。

テストの例:

```
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
```

このテストの例では、WordPressにログインして、管理バーの有無を確認しています。

サンプルとして `example-feature/` ディレクトリ以下にいくつか置いてありますので、そちらも見てください。

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
