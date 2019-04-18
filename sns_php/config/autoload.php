<?php

/*
MyApp
index.php controller
MyApp\Controller\Index　 ←渡ってくるファイル名
-> lib/Controller/Index.php ←MyAppから始まっていたらこちらのファイルを読み込む、と書いていく
*/

spl_autoload_register(function($class) {
	
  $prefix = 'MyApp\\';
	
  if (strpos($class, $prefix) === 0) {
	  
    $className = substr($class, strlen($prefix));
    $classFilePath = __DIR__ . '/../lib/' . str_replace('\\', '/', $className) . '.php';
	  
    if (file_exists($classFilePath)) {
      require $classFilePath;
    }
  }
});


/*
/////////////////////クラスのautoload機能の設定///////////////////////

【全体の名前空間】
”MyApp” 
ControllerやModelのクラスはサブ名前空間に配置する。
例）
index.php に関する Controller のクラスは MyApp\Controller\Index 

【クラスファイルの配置場所】
lib の中に配置したいので、lib の中にサブ名前空間と同じフォルダを作成。そして「クラス名.php」というファイルに設定。


【コード内容】
spl_autoload_register() --- 通常クラスを使用するにはクラスファイルを include() や require()で読み込む必要ありだが、
  　　　　　　　　　　　　　　　　クラス名とファイルの場所に一定のルールが有る場合、spl_autoload_register() を使って自動的に読み込める仕組みを作るのが便利。

$prefix = 'MyApp\\'; 　 全体の名前空間を変数で持つ。

if (strpos($class, $prefix) === 0) 
もしクラス名が MyApp から始まるならば〜と書いていってあげたいので、strpos() ストラポスを使っていく。 strpos() ストラポスとは --- 特定の文字列を含むかのチェック

クラスの $prefix の位置が 0、つまり先頭だったらという意味。

$className = substr($class, strlen($prefix));
まず $className を知りたいので、substr() サブストラで切り出してあげます。　 substr() サブストラとは --- 指定した文字列の一部を取得することができる関数。
どうするかというと…、$prefix (='MyApp\\')としてあげると、（Controller\Index）が切り出されるはずです。


$classFilePath = __DIR__ . '/../lib/' . str_replace('\\', '/', $className) . '.php';
切り出した後、こちらのファイル名（lib/Controller/Index.php）を作っていけば良いので、$classFilePath は現在のディレクトリに対して、ひとつ上のライブラリフォルダなのでこのようにしてあげて、
あとはこの中（'MyApp\\'）にある \ を / （MyApp/Controller/Index.php）に変えてあげれば良いので、str_replace() を使ってあげてこのように書いてあげれば OK ですね。

str_replace() --- 文字列を置換する関数
最後に .php をつければOK！


if (file_exists($classFilePath)) {
      require $classFilePath;
そして、そのファイルが存在していたらそれを読みこめば良いので、そのように書いていってあげます。
file_exists() --- PHPでファイルが存在したら処理をする、といったファイル存在チェック関数

*/