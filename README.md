# Slim-App
[Slim](https://www.slimframework.com/)を使用したスケルトンアプリです。

## インストール
```
composer create-project "kantowatanabe/slim-app=dev-main" {アプリ名}
```

## ディレクトリ階層
```
Slim-App/
├── README.md
├── bin --------------------------------> 実行可能スクリプトのディレクトリ
│   └── console ------------------------> CLIアプリの実行スクリプト
├── composer.json
├── composer.lock
├── config -----------------------------> 設定ファイルディレクトリ
│   ├── commands.php -------------------> CLIアプリのエンドポイント定義
│   ├── dependencies.php ---------------> DI定義
│   ├── env.example.php ----------------> 環境ごとの設定 env.{環境名}.php
│   ├── routes.php ---------------------> ルーティング定義
│   └── settings.php -------------------> 共通設定
├── public -----------------------------> 公開ディレクトリ
│   └── index.php
├── src --------------------------------> ソースファイルディレクトリ
│   ├── Actions ------------------------> Webアプリの実行クラスディレクトリ
│   │   ├── Action.php -----------------> Webアプリの実行クラスの基底クラス
│   │   └── HomeAction.php
│   ├── Commands -----------------------> CLIアプリの実行クラスディレクトリ
│   │   ├── Command.php ----------------> CLIアプリの実行クラスの基底クラス
│   │   └── ExampleCommand.php
│   ├── Handlers -----------------------> エラーハンドラディレクトリ
│   │   ├── HttpErrorHandler.php -------> HTTPエラーハンドラ
│   │   └── ShutdownHandler.php --------> シャットダウンハンドラ
│   ├── Libs ---------------------------> ライブラリディレクトリ
│   └── Middleware ---------------------> ミドルウェアディレクトリ
│       └── ExampleMiddleware.php
├── templates --------------------------> ビューテンプレートディレクトリ
│   └── index.html.twig
└── tmp --------------------------------> 一時的なファイルのディレクトリ
    ├── cache --------------------------> キャッシュ格納先ディレクトリ
    └── logs ---------------------------> ログ出力先ディレクトリ
```

## 実行例

### Webアプリ
1. 以下コマンドを実行
```bash
composer start
```
2. ブラウザで http://localhost:8080/ にアクセス


### CLIアプリ
1. 以下コマンドを実行
```bash
bin/console console:example
```
