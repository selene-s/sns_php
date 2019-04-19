<?php
//パスワードのデータベースへの保存機能　＃19
namespace MyApp\Model;

class User extends \MyApp\Model {

  public function create($values) {//create()でユーザー情報をデータベースに格納していきます。
    $stmt = $this->db->prepare("insert into users (email, password, created, modified) values (:email, :password, now(), now())");
    $res = $stmt->execute([
      ':email' => $values['email'],
      ':password' => password_hash($values['password'], PASSWORD_DEFAULT)
    ]);
    if ($res === false) {
      throw new \MyApp\Exception\DuplicateEmail();
    }
  }
	public function login($values) {
    $stmt = $this->db->prepare("select * from users where email = :email");//(SQL文)ユーザーを取得すれば良いので「select * from users where email = :email」としてあげれば OK 
    $stmt->execute([
      ':email' => $values['email']//execute() する時に渡すデータは email だけなので、このようにしてあげれば OK かと思います。
    ]);
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    $user = $stmt->fetch();//今回データはオブジェクト形式で取得したいので、FetchMode() を設定しておきましょう。そうすると $user が取得できるので、こちらを返してあげれば OK でしょう。

		
	//ただし、$user が存在しない場合だったり、それからパスワードが正しくなかった場合に例外を投げてあげたいので、その辺りを書いていきます。
    if (empty($user)) {
      throw new \MyApp\Exception\UnmatchEmailOrPassword();
    }//$user が存在しない場合は $user が empty() になるはずなので、その場合は前に見たように、こちらの例外を返してあげることにしましょう。

    if (!password_verify($values['password'], $user->password)) {
      throw new \MyApp\Exception\UnmatchEmailOrPassword();
    }//パスワードがマッチしなかった場合
	 //password_verify() で検証できるので、このようにしてあげて、渡ってきたデータと、$user のパスワードを調べてあげれば OK 
		
    return $user;
  }
	public function findAll() {
    $stmt = $this->db->query("select * from users order by id");
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    return $stmt->fetchAll();
  }//登録しているユーザーの一蘭
}

/*



*/