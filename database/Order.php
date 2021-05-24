<?php

class Order
{
    public $db = null;

    public function __construct()
    {
        $db = new DBController();
        if (!isset($db->con)) return null;
        $this->db = $db;
    }

    public function makeOrder($table = 'order_table')
    {
        // Total Sum
        $sum = 0;
        foreach ($_SESSION['totalCart'] as $item) {
            $sum += floatval($item[0][0]) * $item[0][1];
        }

        $type = 'COD';
        $query = "INSERT INTO order_table(user_id, order_price, payment_type) VALUES ('{$_SESSION['user_id']}', '$sum', '$type')";
        $result = $this->db->con->query($query);

        if ($result) {
            $last_id = mysqli_insert_id($this->db->con);
            foreach ($_SESSION['totalCart'] as $order_item) {
                // print("<pre>" . print_r($order_item, true) . "</pre>");
                // exit;
                $item_total_price = $order_item[0][1] * $order_item[0][0];
                $table = 'order_items';
                $params = [
                    "order_id" => $last_id,
                    "item_id" => $order_item[0][2],
                    "item_price" => $order_item[0][0],
                    "qty" => $order_item[0][1],
                    "total_price" => $item_total_price,
                ];

                $columns = implode(',', array_keys($params));
                $values = implode(',', array_values($params));

                $query = sprintf("INSERT INTO %s(%s) VALUES(%s)", $table, $columns, $values);

                $result2 = $this->db->con->query($query);
            }
        }

        if ($result2) {
            foreach ($_SESSION['totalCart'] as $order_item) {
                $query = "DELETE FROM cart WHERE user_id = {$_SESSION['user_id']} and item_id = {$order_item[0][2]}";

                $result = $this->db->con->query($query);

                unset($_SESSION['totalCart']);
                if ($result) header("Location: confirm-order.php");
            }
        }
    }

    public function getData()
    {
        $query = "SELECT * FROM order_table, user WHERE order_table.user_id =  user.user_id";
        $result = $this->db->con->query($query);

        $resultArray = array();
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArray[] = $item;
        }
        return $resultArray;
    }

    public function getOrderItems()
    {
        $query = "SELECT * FROM order_table, order_items, product WHERE order_table.order_id =  order_items.order_id AND order_items.item_id = product.item_id";
        $result = $this->db->con->query($query);

        $resultArray = array();
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArray[] = $item;
        }
        return $resultArray;
    }

    public function updateStatus($id, $status)
    {
        if (isset($id) && isset($status)) {
            $query = "UPDATE order_table 
            SET status='$status' 
            WHERE order_id=$id";

            $result = $this->db->con->query($query);
            return $result;
        }
    }

    public function getMyOrders()
    {
        if (isset($_SESSION['user_id'])) {
            $query = "SELECT * FROM order_table, user 
            WHERE order_table.user_id={$_SESSION['user_id']} 
            AND order_table.user_id =  user.user_id";

            $result = $this->db->con->query($query);

            $resultArray = array();
            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $resultArray[] = $item;
            }
            // print("<pre>" . print_r($resultArray, true) . "</pre>");
            // exit;
            return $resultArray;
        }
    }

    public function getMyOrdersItems()
    {
        if (isset($_SESSION['user_id'])) {
            $query = "SELECT * FROM order_table, order_items, product WHERE order_table.user_id={$_SESSION['user_id']} AND order_table.order_id =  order_items.order_id AND order_items.item_id = product.item_id";

            $result = $this->db->con->query($query);

            $resultArray = array();
            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $resultArray[] = $item;
            }
            // print("<pre>" . print_r($resultArray, true) . "</pre>");
            // exit;
            return $resultArray;
        }
    }
}
