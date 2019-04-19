<?php
//Controller にエラーオブジェクトを持たせて setErrors() とか getErrors() のメソッドを作っていきましょう。
//これらの処理は Controller 共通の処理としてまとめておきたいので Controller.php のほうに書いていきます。
namespace MyApp;

class Controller {

  private $_errors;//まずはエラー情報を格納するためのプライベードプロパティを宣言してあげましょう。
  private $_values;//パスワードエラーが出た時にも、入力した email アドレスは残るように
	
  public function __construct() {//それからそちらを初期化したいのでコンストラクタでやっていきましょう
    if (!isset($_SESSION['token'])) {
      $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
    }//もし $_SESSION['token'] がセットされていなかったら（セット）しなさい。
	 //推測されにくい文字列にすれば良いのですが、最近は openssl_random_pseudo_bytes(16) という命令を使うのが一般的らしいので、このようにしてあげると 32 桁の推測されにくい文字列が作られるはずです。lesson#16 
	  
	  
    $this->_errors = new \stdClass();
	$this->_values = new \stdClass();
  }//今回はこちらの $this->_errors は PHP の stdClass() にしておきたいと思います。
   //この stdClass() なのですが、PHP デフォルトのクラスで宣言することなくいきなり new して使うことができる特殊なオブジェクトになっています。オブジェクト型のデータをさっと作りたい時に便利。
	
  protected function setValues($key, $value) {
    $this->_values->$key = $value;
  }	//setValues() に関しては $key と $value を渡したら、その $key に対して $value を設定してあげれば OK でしょう。
	
  public function getValues() {
    return $this->_values;
  }//getValues() に関して言うと、getErrors() と違って、エラーメッセージだけではなくて複雑なデータが入ってくる可能性があるので、引数無しでまるごとオブジェクトを返してもらうことにしましょう。
	
  protected function setErrors($key, $error) {
    $this->_errors->$key = $error;
  }//setErrors()は継承されたクラスから使うので protected にしてあげつつ、setErrors としてあげて、$key と$error を渡してあげるとしてあげましょう。

  public function getErrors($key) {
    return isset($this->_errors->$key) ?  $this->_errors->$key : '';
  }//getErrors() に関しては、インスタンスから呼ぶので public にしないと駄目ですね。
   //もしセットされていたらこれを返せば良いですし、そうでなかったら空文字と書いてあげます。
	
  protected function hasError() {
    return !empty(get_object_vars($this->_errors));
  }//こちらも継承されたクラスから使うので protected で、hasError としてあげて…、引数はなしですね。
   //こちらの $this->_errors を調べてあげて、それが空でなかったら、としてあげれば OK ですね。
   //empty とした後に get_object_vars でプロパティを取得してあげましょう。	

  protected function isLoggedIn() {
    // $_SESSION['me']
    return isset($_SESSION['me']) && !empty($_SESSION['me']);
  }//($_SESSION['me'])がセットされていて、かつ、空じゃなかったら。
	
  public function me() {
    return $this->isLoggedIn() ? $_SESSION['me'] : null;
  }	//ログインしているユーザーの情報が取れる
	
/*
「class Contoller {...}」としてあげて isLoggedIn() を作っていきたいのですが、継承したクラスからも使うので protected にしてあげましょう。
今回、どのようにログイン状態を判定するかなのですが、ログインした時にセッションに me というキーで情報を保持していきたいと思うので、その中身を見てログインしているかどうかを判定してあげましょう。*/
	
  /*public function me() {
    return $this->isLoggedIn() ? $_SESSION['me'] : null;
  }*/
}