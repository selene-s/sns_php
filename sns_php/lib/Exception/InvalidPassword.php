<?php

namespace MyApp\Exception;

class InvalidPassword extends \Exception {
  protected $message = 'Invalid Password!';
}
/*InvalidPassword クラスを作成。だけど、\Exceptionを継承*/
/*
private	そのクラスからしかアクセスできない
protected	そのクラスと、サブクラスからしかアクセスできない
public	どこからでもアクセスできる
*/