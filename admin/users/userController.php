<?php

require_once(dirname(__DIR__) . '/../database/Product.php');

class userController
{
    public $Product;
    public function __construct()
    {
        $this->Product = new Product();
    }

    public function index()
    {
        $users = $this->Product->getData('user');
        return include('../views/users/list.php');
    }
}
