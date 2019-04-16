<?php

// 新規登録

require_once(__DIR__ . '/../config/config.php');

$app = new MyApp\Controller\Signup();

$app->run();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Sign Up</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div id="container">
    <form action="" method="post" id="signup">
      <p>
        <input type="text" name="email" placeholder="email" value="<?= isset($app->getValues()->email) ? h($app->getValues()->email) : ''; ?>">
		  <!--getValues() で返ってくる stdClass() は存在しないプロパティにアクセスすると Notice が出てしまうので、isset() で$app->getValues()->emailを調べてあげると良いかと思います。これがもしセットされていたらエスケープしつつ表示をしてあげて、そうでなかったら空文字としてあげれば OK かと思います。-->
      </p>
	  <p class="err"><?= h($app->getErrors('email')); ?></p>
      <p>
        <input type="password" name="password" placeholder="password">
      </p>
	  <p class="err"><?= h($app->getErrors('password')); ?></p>
      <div class="btn" onclick="document.getElementById('signup').submit();">Sign Up</div>
      <p class="fs12"><a href="/login.php">Log In</a></p>
	  <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
		<!--Controller.php12行目より #16-->
    </form>
  </div>
</body>
</html>

<!--#16 CSRF 対策-->
<!--色々なやり方がありますが、変なフォームから投稿されていないかチェックしたいので、セッションに token を仕込みつつ、フォームから渡された token と一致するか見てあげます。-->
<!--token をまず作りたいのですが、こちらのインスタンスができた時に仕込んでいきたいと思うので、Controller.php のコンストラクターでやっていけば良いでしょう。-->