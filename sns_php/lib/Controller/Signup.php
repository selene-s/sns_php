<?php

namespace MyApp\Controller;

class Signup extends \MyApp\Controller {

  public function run() {
    if ($this->isLoggedIn()) {
      header('Location: ' . SITE_URL);
      exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->postProcess();
    }
  }
//SignUp のところは新規登録のフォームがあるので、フォームがもしポストされたらと書いていってあげれば OK 
	

  protected function postProcess() {
  //////////////validate
    try {
      $this->_validate();
    } catch (\MyApp\Exception\InvalidEmail $e) {
      //echo $e->getMessage();
      //exit;
	  $this->setErrors('email', $e->getMessage());
    } catch (\MyApp\Exception\InvalidPassword $e) {
      //echo $e->getMessage();
      //exit;
	  $this->setErrors('password', $e->getMessage());
    }

    //echo "success";
    //exit;
	  
	$this->setValues('email', $_POST['email']);
  

	if ($this->hasError()) {
      return;
    } else {
//////////////// create user
	  try {
        $userModel = new \MyApp\Model\User();//$userModelのインスタンスを作成
        $userModel->create([
          'email' => $_POST['email'],
          'password' => $_POST['password']
        ]);
      } catch (\MyApp\Exception\DuplicateEmail $e) {
        $this->setErrors('email', $e->getMessage());
        return;//例外処理なのですが考えられるエラーとしては、email が既に存在する場合なので…、その場合は DuplicateEmail という例外を返してあげましょう
      }

/////////////// redirect to login
      header('Location: ' . SITE_URL . '/login.php');
      exit;
    }
  }

  private function _validate() {
	if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
      echo "Invalid Token!";
      exit;
    }//tokenの検証 #16
	  
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      throw new \MyApp\Exception\InvalidEmail();
    }

    if (!preg_match('/\A[a-zA-Z0-9]+\z/', $_POST['password'])) {
      throw new \MyApp\Exception\InvalidPassword();
    }
  }//'/\A[a-zA-Z0-9]+\z/' パスワードの正規表現

}

/*public function run()〜 runメソッドの作成

if (!$this->isLoggedIn()) 
もしログインしていなければログイン画面に飛ばすという処理を最初にやらないとなりません。

 header('Location: ' . SITE_URL);
      exit;
 まずクラス名を Signup としてあげて、こちらに関してはログインしていたらホームに飛ばせばいいですね。
 
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->postProcess();
 SignUp のところは新規登録のフォームがあるので、フォームがもしポストされたらと書いていってあげれば OK ですね。
 なので、$_SERVER['REQUEST_METHOD'] === 'POST' だった場合、次の処理をしなさいと書いてあげましょう。
 
 ▼postProcess() というメソッド
 form が投稿された時にはまずデータの検証をして、それが OK だったらユーザーを作って、そして「redirect to login」にしてあげれば登録処理が完了という形を作る
 将来の拡張性も考えて protected で作る
 
 
 URL なのですが定数で管理しておいたほうが良いので、SITE_URL としてあげて、後で config.php に書いていってあげましょう。
 
 
 
そうではない場合はユーザーの情報を取得してあげる、と書いてあげれば OK 

try --- 発生した例外を補足。　tryブロックで囲んで、catch or finallyブロックで応対




*/