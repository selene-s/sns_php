<?php
//ログイン処理を行なうためのControllerを作っていきます。#20 （Signup.phpより複製）

namespace MyApp\Controller;

class Login extends \MyApp\Controller {

  public function run() {
    if ($this->isLoggedIn()) {
      header('Location: ' . SITE_URL);
      exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->postProcess();
    }
  }

  protected function postProcess() {
    try {
      $this->_validate();
    } catch (\MyApp\Exception\EmptyPost $e) {//考えられる例外としては、何も入力されなかった場合があるので、EmptyPost という例外を後で作っていきましょう。
      $this->setErrors('login', $e->getMessage());//その場合は login というキーでセットしてあげれば OK
    }

    $this->setValues('email', $_POST['email']);

    if ($this->hasError()) {
      return;
    } else {
      try {
        $userModel = new \MyApp\Model\User();
        $user = $userModel->login([//こちらは create user ではなくて、$userModel->login() としてあげれば OK
          'email' => $_POST['email'],
          'password' => $_POST['password']
        ]);
      } catch (\MyApp\Exception\UnmatchEmailOrPassword $e) {//ここで考えられる例外としては、password と email がマッチしないというものがあるので…、UnmatchEmailOrPassword としてあげれば OK でしょう。
        $this->setErrors('login', $e->getMessage());
        return;
      }

      // login処理
      session_regenerate_id(true);//セッションハイジャック対策
      $_SESSION['me'] = $user;
		
		
      // redirect to home
      header('Location: ' . SITE_URL);//login 処理をした後に home にリダイレクト
      exit;
    }
  }

  private function _validate() {
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
      echo "Invalid Token!";
      exit;
    }

    if (!isset($_POST['email']) || !isset($_POST['password'])) {
      echo "Invalid Form!";
      exit;//email と password がセットされていないとおかしい。の検証
    }

    if ($_POST['email'] === '' || $_POST['password'] === '') {
      throw new \MyApp\Exception\EmptyPost();
    }//$_POST['email'] が空文字、もしくは $_POST['password'] が空文字だった場合、そういった例外を出してあげれば良い
  }

}