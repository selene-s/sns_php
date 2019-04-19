<?php

// ログイン

require_once(__DIR__ . '/../config/config.php');

$app = new MyApp\Controller\Login();

$app->run();

// echo "login screen";
// exit;

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Log In</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div id="container">
    <form action="" method="post" id="login">
	  <p class="title">Enter your login</p>	
      <p>
        <input type="text" name="email" placeholder="email" value="<?= isset($app->getValues()->email) ? h($app->getValues()->email) : ''; ?>"><!--email もエラーが出た時に、残っていて欲しいので、ここもコピーしてあげましょう。from signup.phpより必要箇所をコピー　＃21-->
      </p>
      <p>
        <input type="password" name="password" placeholder="password">
      </p>
      <p class="err"><?= h($app->getErrors('login')); ?></p><!--エラーメッセージ-->
      <div class="btn" onclick="document.getElementById('login').submit();">Log In</div><!-- submit の仕組みもコピー-->
      <p class="fs12"><a href="/signup.php">Sign Up</a></p>
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>"><!--token-->
    </form>
  </div>
</body>
</html>