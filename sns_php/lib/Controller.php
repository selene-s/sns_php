<?php
//Controller にエラーオブジェクトを持たせて setErrors() とか getErrors() のメソッドを作っていく。
//これらの処理は Controller 共通の処理としてまとめておきたいので Controller.php のほうに書く。
namespace MyApp;

class Controller {

  private $_errors;//まずはエラー情報を格納するためのプライベードプロパティを宣言。
  private $_values;//パスワードエラーが出た時にも、入力した email アドレスは残るように
	
  public function __construct() {//それからプライベートプロパティを初期化したいのでコンストラクタ使用
    if (!isset($_SESSION['token'])) {
      $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
    }//もし $_SESSION['token'] がセットされていなかったら（セット）しなさい。
	 //推測されにくい文字列にすれば良いのですが、最近は openssl_random_pseudo_bytes(16) という命令を使うのが一般的らしいので、このようにしてあげると 32 桁の推測されにくい文字列が作られるはずです。lesson#16 
	  
	  
    $this->_errors = new \stdClass();
	$this->_values = new \stdClass();
  }//PHP の stdClass() 
   //この stdClass() は、PHP デフォルトのクラスで宣言することなくいきなり new して使うことができる特殊なオブジェクトになっています。オブジェクト型のデータをさっと作りたい時に便利。
	
  protected function setValues($key, $value) {
    $this->_values->$key = $value;
  }	//setValues() に関しては $key と $value を渡したら、その $key に対して $value を設定してあげれば OK でしょう。
	
  public function getValues() {
    return $this->_values;
  }//getValues() に関して言うと、getErrors() と違って、エラーメッセージだけではなくて複雑なデータが入ってくる可能性があるので、引数無しでまるごとオブジェクトを返してもらうことにしましょう。
	
  protected function setErrors($key, $error) {
    $this->_errors->$key = $error;
  }//setErrors()は継承されたクラスから使うので protected にしてあげつつ、setErrors としてあげて、$key と$error を渡してあげる

  public function getErrors($key) {
    return isset($this->_errors->$key) ?  $this->_errors->$key : '';
  }//getErrors() に関しては、インスタンスから呼ぶので public にしないと駄目。
   //もしセットされていたらこれ（$key）を返せば良いですし、そうでなかったら空文字''と書いてあげます。
  protected function hasError() {
    return !empty(get_object_vars($this->_errors));
  }//こちらも継承されたクラスから使うので protected で、hasError としてあげて引数はなし。
   //$this->_errors を調べてあげて、それが空でなかったら、としてあげれば OK。
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