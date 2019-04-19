<?php


ini_set('display_errors', 1);

define('DSN', 'mysql:host=localhost;dbname=dotinstall_sns_php');
define('DB_USERNAME', 'dbuser');
define('DB_PASSWORD', 'mu4uJsif');
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);


require_once(__DIR__ . '/../lib/functions.php');
require_once(__DIR__ . '/autoload.php');


session_start();

/*
/////////////アプリ全体の設定を記述するファイル

ini_set --- 指定した設定オプションの値を設定します。（イニセット）
'display_errors'の数値を１にしておくと、ブラウザのほうにエラー表示をしてくれるので便利

--------------------------------------------------------------------

データベース設定の定数化
今回、PDO を使っていくので、DSN をまずは定義する。

PDO --- PHPでデータベースを利用　例外処理　データベース接続クラスのこと　(PHP Database Object)
DSO --- Data Souce nameのこと

define() --- define関数では定数を定義することができる。define関数で指定した定数はプログラム内のどこからでも(クラスの中からも外からも)定数を呼び出せます。
$_SERVER['HTTP_HOST']);　--- IPアドレスとポート番号が入ってくる
-------------------------------------------------------------------

require_once --- 外部ファイルを一度だけ読み込む制御構文。
                 require文は、何度でも再読み込みできるが、require_once文は、一度読み込んだファイルを再読み込みすることはない。
				 
__DIR__　--- 現在のディレクトリを示す
.        --- #連結のドット

例）
__DIR__ . '/../lib/functions.php'　現在のディレクトリの一個上の階層にあるlib/functions.phpを一度読み込む　

---------------------------------------------------------------------------------------------

session_start() --- 新しいセッションを開始、あるいは既存のセッションを再開する
                    session_start() がコールされたりセッションが自動的に開始したりするときに、 
					PHP はセッションの open および read をコールする。

*/





