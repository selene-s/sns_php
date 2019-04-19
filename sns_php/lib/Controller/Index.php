<?php

namespace MyApp\Controller;

/*クラスを書いていくが、共通処理を書いた Controllerクラスを継承すればOKなので、extends MyApp\Controller {...} */
class Index extends \MyApp\Controller {

  public function run() {
    if (!$this->isLoggedIn()) {
      // login
      header('Location: ' . SITE_URL . '/login.php');
      exit;
    }

    // get users info
    $userModel = new \MyApp\Model\User();
    $this->setValues('users', $userModel->findAll());
  }

}

/*public function run()〜 runメソッドの作成

if (!$this->isLoggedIn()) 
もしログインしていなければログイン画面に飛ばすという処理を最初に

header('Location: ' . SITE_URL . '/login.php');
      exit;
ログインしてなかったらログイン画面に飛ばしていってあげたいので、リダイレクトをかける。
 （リダイレクトを）かける先が login.php の View に飛ばしていきたいので、Location で飛ばしていきましょう。
 
 header関数とLocation --- header関数では、Locationと書いてから、飛び先のURLを書きます。
   　　　　　　　　　　　　　この際、httpから始まる絶対パスでも、.から始まる相対パスでもOK。

 URLは定数で管理。 SITE_URL としてあげて、後で config.php に記入
 
 
 

そうではない場合はユーザーの情報を取得してあげる、と書いてあげれば OK 




*/