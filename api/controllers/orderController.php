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

    function filter_by_value($array, $index, $value)
    {
        if (is_array($array) && count($array) > 0) {
            foreach (array_keys($array) as $key) {
                $temp[$key] = $array[$key][$index];

                if ($temp[$key] == $value) {
                    $newarray[$key] = $array[$key];
                }
            }
        }
        return $newarray;
    }

    public function read($user_id, $type)
    {
        $orders = $this->Order->getData();

        if ($user_id && $type != 'admin') $orders = $this->filter_by_value($orders, 'user_id', $user_id);
        if (count($orders) != 0) {
            http_response_code(200);
            return print_r(json_encode($orders));
        }
        http_response_code(404);
        return print_r(json_encode(['message' => 'No orders found']));
    }

    public function readOne($user_id, $type)
    {
        // echo $user_id;
        // exit;

        if ($type == 'admin') $user_id = $_GET['user_id'] ?? null;
        if (isset($_GET['order_id']) || isset($user_id)) {

            if (isset($user_id)) {
                if (!is_numeric($user_id)) return print_r(json_encode(['message' => 'Id should be numeric']));

                $user = $this->User->getUser($user_id);
                if (!isset($user)) return print_r(json_encode(['message' => 'No user found for this used_id']));

                $_SESSION['user_id'] = $user_id;
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
