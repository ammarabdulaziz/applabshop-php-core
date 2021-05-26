<?php

require_once(dirname(__DIR__) . '/../database/Product.php');
require_once(dirname(__DIR__) . '/../database/Order.php');
require_once(dirname(__DIR__) . '/../database/User.php');

class orderController
{
    public $Order;
    public $Product;
    public $User;
    public function __construct()
    {
        $this->Order = new Order();
        $this->Product = new Product();
        $this->User = new User();
    }

    public function read()
    {
        $orders = $this->Order->getData();

        if (count($orders) != 0) {
            http_response_code(200);
            return print_r(json_encode($orders));
        }
        http_response_code(404);
        return print_r(json_encode(['message' => 'No orders found']));
    }

    public function readOne()
    {
        if (isset($_GET['order_id']) || isset($_GET['user_id'])) {

            if (isset($_GET['user_id'])) {
                if (!is_numeric($_GET['user_id'])) return print_r(json_encode(['message' => 'Id should be numeric']));

                $user = $this->User->getUser($_GET['user_id']);
                if (!isset($user)) return print_r(json_encode(['message' => 'No user found for this used_id']));

                $_SESSION['user_id'] = $_GET['user_id'];
                $orders = $this->Order->getMyOrders();
            }

            if (isset($_GET['order_id'])) {
                if (!is_numeric($_GET['order_id'])) return print_r(json_encode(['message' => 'Id should be numeric']));
                $orders = $this->Order->getByOrderId($_GET['order_id']);
            }

            if (count($orders) != 0) {
                unset($_SESSION['user_id']);
                http_response_code(200);
                return print_r(json_encode($orders));
            }

            unset($_SESSION['user_id']);
            http_response_code(404);
            return print_r(json_encode(['message' => 'No orders found for this user_id/order_id']));
        } else {
            return print_r(json_encode(['message' => 'Invalid pramater key']));
        }
    }
}
