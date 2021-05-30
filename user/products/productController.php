<?php


require_once(dirname(__DIR__) . '/../database/Product.php');
require_once(dirname(__DIR__) . '/../database/Cart.php');

class productController
{
    public $Product;
    public $Cart;
    public function __construct()
    {
        $this->Product = new Product();
        $this->Cart = new Cart();
    }

    public function index()
    {
        $products = $this->Product->getData();
        $Cart = $this->Cart;
        return include('../views/products/list.php');
    }
}
