<?php

namespace MyApp\Exception;

class InvalidEmail extends \Exception {
  protected $message = 'Invalid Email!';
}

/*
MyApp\Exception　--- namespaceの設定

クラスは InvalidEmail としてあげて、標準の Exception クラスを継承
$message を上書きしてあげれば良いので、こちらに自分で分かりやすいメッセージ入れる
→今回は'Invalid Password!';

*/