<?php

class Order
{
    public $db = null;

    public function __construct(DBController $db)
    {
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
}
