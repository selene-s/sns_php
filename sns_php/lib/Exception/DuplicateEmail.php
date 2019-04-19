<?php

namespace MyApp\Exception;

class DuplicateEmail extends \Exception {
  protected $message = 'Duplicate Email!';
}

//DuplicateEmail の Exception(エクセプション＝例外)文言　 lesson＃17にて