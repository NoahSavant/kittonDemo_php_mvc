
<?php
class User
{
  public $id = -1;
  public $username;
  public $password;
  public $email;

  function __construct($id, $username, $password, $email)
  {
    $this->id = $id;
    $this->username = $username;
    $this->password = $password;
    $this->email = $email;
  }

  static function registration($username, $password, $email)
  {
    $db = DB::getInstance();

    $sql = "INSERT INTO users (username, password, email) VALUES ('" . $username . "', '" . $password . "', '" . $email ."');";

    // Sử dụng hàm exec() để thực hiện truy vấn INSERT

    $result = $db->exec($sql);

    return $result;
  }

  static function login($username, $password)
  {
    $list = [];
    $db = DB::getInstance();
    $req = $db->query('SELECT * FROM users');

    foreach ($req->fetchAll() as $item) {
      $list[] = new User($item['id'], $item['username'], $item['password'], $item['email']);
    }

    foreach($list as $item) {
      if($item->username === $username and $item->password === $password) {
        return $item;
      }
    }

    return new User('','','');
  }
}
