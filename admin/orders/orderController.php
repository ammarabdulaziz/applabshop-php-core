<?php

require_once(dirname(__DIR__) . '/../database/Order.php');

class orderController
{
    public $Order;
    public function __construct()
    {
        $this->Order = new Order();
    }

    public function index()
    {
        $orders = $this->Order->getData();
        $order_items = $this->Order->getOrderItems();
        return include('../views/orders/list.php');
    }

    public function change()
    {
        $result = $this->Order->updateStatus($_POST['order_id'], $_POST['status']);
        echo json_encode($result);
    }
}
