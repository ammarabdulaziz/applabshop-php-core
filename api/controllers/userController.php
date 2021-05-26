<?php

require_once(dirname(__DIR__) . '/../database/Product.php');
require_once(dirname(__DIR__) . '/../database/User.php');

class userController
{
    public $User;
    public $Product;
    public function __construct()
    {
        $this->User = new User();
        $this->Product = new Product();
    }

    public function read($user_id, $type)
    {
        $users = $this->Product->getData('user');

        if ($user_id && $type != 'admin') foreach ($users as $user) {
            if ($user['user_id'] == $user_id) $users = $user;
        }

        if (count($users) != 0) {
            http_response_code(200);
            return print_r(json_encode($users));
        }
        http_response_code(404);
        return print_r(json_encode(['message' => 'No users found']));
    }

    public function readOne($user_id, $type)
    {
        if ($type == 'admin') {
            if (!isset($_GET['user_id'])) return print_r(json_encode(['message' => 'Parameter user_id not provided']));
            if (!is_numeric($_GET['user_id'])) return print_r(json_encode(['message' => 'Id should be numeric']));
            $user_id = $_GET['user_id'];
        }

        $user = $this->User->getUser($user_id);

        if (isset($user)) {
            http_response_code(200);
            return print_r(json_encode($user));
        }

        http_response_code(404);
        return print_r(json_encode(['message' => 'No user found']));
    }
}
