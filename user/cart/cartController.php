<?php

require_once(dirname(__DIR__) . '/../database/Cart.php');
require_once(dirname(__DIR__) . '/../database/Product.php');

class cartController
{
    public $Cart;
    public $Product;
    public function __construct()
    {
        $this->Cart = new Cart();
        $this->Product = new Product();
    }

    public function index()
    {
        $Cart = $this->Cart;
        $Product = $this->Product;
        return include('../views/cart/list.php');
    }
}
