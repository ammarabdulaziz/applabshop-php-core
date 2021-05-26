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

    public function read()
    {
        $users = $this->Product->getData('user');

        if (count($users) != 0) {
            http_response_code(200);
            return print_r(json_encode($users));
        }
        http_response_code(404);
        return print_r(json_encode(['message' => 'No users found']));
    }

    public function readOne()
    {
        if (!isset($_GET['id'])) return print_r(json_encode(['message' => 'Invalid pramater key']));
        if (!is_numeric($_GET['id'])) return print_r(json_encode(['message' => 'Id should be numeric']));

        $user = $this->User->getUser($_GET['id']);

        if (isset($user)) {
            http_response_code(200);
            return print_r(json_encode($user));
        }

        http_response_code(404);
        return print_r(json_encode(['message' => 'No user found']));
    }
}
