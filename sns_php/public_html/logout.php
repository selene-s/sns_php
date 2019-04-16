<?php

require_once(__DIR__ . '/../config/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
    echo "Invalid Token!";
    exit;
  }
//ログアウトは POST されるので、まずそこら辺を調べてあげると良い。$_SERVER['REQUEST_METHOD'] が POST だったら…、

	
	
  $_SESION = [];
//$_SESSION を空にしてあげて、それから PHP ではセッションの管理にクッキーを使うので、そちらのクッキーも削除
	
	
  if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 86400, '/');
  }

  session_destroy();

}
//クッキーの名前は session_name() で取れるので、このクッキーがもしセットされていたら削除とする
//名前が session_name() で、内容は空にしてあげて、そして有効期限を過去日付にしてあげれば削除ができます	




header('Location: ' . SITE_URL);
//index.php に飛ばしてあげたいので、リダイレクトをかけてあげましょう。