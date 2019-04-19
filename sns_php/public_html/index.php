<?php

///////////////ユーザーの一覧

/*config の情報を呼び出してあげたいので、今いるディレクトリのひとつ上の config ディレクトリの config.php を読み込む*/
require_once(__DIR__ . '/../config/config.php');



/*このビューに表示するデータを Controller から引っ張ってくる処理*/
/*Controllerのインスタンスを作る*/
$app = new MyApp\Controller\Index();

/*run() というメソッドを呼び出してあげて、ユーザーの一覧を表示するのに必要なデータを引っ張ってくる。それをHTMLへ反映させる*/
$app->run();

// $app->me() → Controller.phpの方で実装
// $app->getValues()->users

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Home</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div id="container">
    <form action="logout.php" method="post" id="logout">
      <?= h($app->me()->email); ?> <input type="submit" value="Log Out" class="logout-button">
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </form>
    <h1>Users <span class="fs12">(<?= count($app->getValues()->users); ?>)</span></h1>
    <ul>
      <?php foreach ($app->getValues()->users as $user) : ?>
        <li><?= h($user->email); ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</body>
</html>
