<?php

require_once(dirname(__DIR__) . '/../database/Order.php');
require_once(dirname(__DIR__) . '/../database/Cart.php');

class orderController
{
    public $Order;
    public $Cart;
    public function __construct()
    {
        $this->Order = new Order();
        $this->Cart = new Cart();
    }

    public function index()
    {
        $Cart = $this->Cart;
        $myOrders = $this->Order->getMyOrders();
        $myOrdersItems = $this->Order->getMyOrdersItems();
        return include('../views/orders/list.php');
    }

    public function checkout()
    {
        $this->Order->makeOrder();
        return header('Location: /applabshop/user/products/index.php');
    }
}
