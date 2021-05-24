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
        return include('./views/login.php');
    }

    public function loginUser()
    {
        $errors = array('name' => '', 'username' => '', 'password' => '');
        $checkout = isset($_GET['checkout']) && $_GET['checkout'] == 'true' ? true : null;
        $orders = isset($_GET['orders']) && $_GET['orders'] == 'true' ? true : null;

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
}
