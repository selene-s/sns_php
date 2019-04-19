<?php


namespace MyApp;

class Model {
  protected $db;

  public function __construct() {
    try {
      $this->db = new \PDO(DSN, DB_USERNAME, DB_PASSWORD);
    } catch (\PDOException $e) {
      echo $e->getMessage();
      exit;
    }
  }
}  

/*

//////////////////Userモデルの作成　 

拡張性も考えて、共通処理を Model.php に書いて、それ以外のものを Modelフォルダ(User.php)の中に入れる

protected $db; --- データベースの接続

__construct() --- クラスからインスタンスを生成する際（new を行う際）に最初に実行される関数
                  コンストラクタの利用目的としては主にインスタンスを生成するときの初期化に用いる。
				  
try してあげて、$this->db を \PDO() のインスタンスを作って割り当ててあげれば OK
   //「new \PDO(DSN, DB_USERNAME, DB_PASSWORD);」とすれば OK でしょう。
   //catch で \PDOException が返ってくる場合があるので、その場合は今回は単にメッセージを表示して、強制終了させてしまえば良いかと思います。#18


*/