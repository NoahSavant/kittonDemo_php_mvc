
<?php
require_once('controllers/base_controller.php');
require_once('models/user.php');

class UsersController extends BaseController
{
  function __construct()
  {
    session_start();
    $this->folder = 'users';
  }

  public function index()
  {
    if (isset($_SESSION['username'])) {
        $user = User::login($_SESSION['username'], $_SESSION['password']);
        $data = array('user' => $user);
        $this->render('index', $data);
    } else {
        $user = ""; 
        $data = array('user' => $user);
        $this->render('login', $data);
    }
  }

  public function login() {
    $user = ""; 
    $data = array('user' => $user);
    $this->render('login', $data);
  }

  public function postLogin() {
    $user = User::login($_POST['username'], $_POST['password']);
    if($user->id === -1) {
        $this->login();
    }
    else {
        $_SESSION['username'] = $user->username;
        $_SESSION['password'] = $user->password;
        $this->index();
    }
    
  }

  public function registration() {
    $user = ""; 
    $data = array('user' => $user);
    $this->render('registration', $data);
  }  

  public function postRegistration() {
    if($_POST['password1'] === $_POST['password2']) {
        $result = User::registration($_POST['username'], $_POST['password1'], $_POST['email']);
        if($result === 1) { 
            $this->login();
            return;
        }
    }
    $this->registration();
  }  

  public function logout() {
    session_unset();
    $this->login();
  }  
}
