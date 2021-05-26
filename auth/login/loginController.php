<?php

require_once(dirname(__DIR__) . '/../database/User.php');

class loginController
{
    public $User;
    public function __construct()
    {
        $this->User = new User();
    }

    public function index()
    {
        // $users = $this->User->getData();
        // $User = $this->User;
        $checkout = isset($_GET['checkout']) && $_GET['checkout'] == 'true' ? true : null;
        $orders = isset($_GET['orders']) && $_GET['orders'] == 'true' ? true : null;
        $login = isset($_GET['login']) && $_GET['login'] == 'false' ? true : null;
        return include('./views/login.php');
    }

    public function loginUser()
    {
        $errors = array('name' => '', 'username' => '', 'password' => '');
        $checkout = isset($_GET['checkout']) && $_GET['checkout'] == 'true' ? true : null;
        $orders = isset($_GET['orders']) && $_GET['orders'] == 'true' ? true : null;
        $login = isset($_GET['login']) && $_GET['login'] == 'false' ? true : null;

        if (isset($_POST['submit'])) {
            if (empty($_POST['username'])) $errors['username'] = 'Username is empty';
            if (empty($_POST['password'])) $errors['password'] = 'Password is empty';

            if (!array_filter($errors)) {
                $error = $this->User->loginUser($_POST['username'], md5($_POST['password']), $checkout, $orders);
                if (isset($error)) return include('./views/login.php');
            } else {
                return include('./views/login.php');
            }
        }
    }

    public function loginJWT()
    {
        $error = [];
        if (!isset($_POST['username']) || empty($_POST['username'])) array_push($error, 'username');
        if (!isset($_POST['password']) || empty($_POST['password'])) array_push($error, 'password');

        $params = implode(', ', $error);
        if (count($error) > 0) return print_r(json_encode(['message' => 'Fields ' . $params . ' not entered correctly']));

        $error = $this->User->JWTlogin($_POST['username'], md5($_POST['password']));
        if (isset($error)) return print_r(json_encode(['message' => 'Login failed']));
    }
}
