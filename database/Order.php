<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once(dirname(__DIR__) . '/PHPMailer/src/PHPMailer.php');
require_once(dirname(__DIR__) . '/PHPMailer/src/SMTP.php');
require_once(dirname(__DIR__) . '/PHPMailer/src/Exception.php');

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
                if ($result) {
                    $order = $this->getByOrderId($params['order_id']);
                    // print("<pre>" . print_r($order) . "</pre>");
                    // exit;
                    header("Location: /applabshop/user/views/orders/confirm-order.php");
                    // $sent = $this->sendConfirmationEmail($params);
                }
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
        $query = "SELECT * FROM order_table, order_items, product 
        WHERE order_table.order_id =  order_items.order_id 
        AND order_items.item_id = product.item_id";
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
            return $resultArray;
        }
    }

    public function getMyOrdersItems()
    {
        if (isset($_SESSION['user_id'])) {
            $query = "SELECT * FROM order_table, order_items, product 
            WHERE order_table.user_id={$_SESSION['user_id']} 
            AND order_table.order_id =  order_items.order_id 
            AND order_items.item_id = product.item_id";

            $result = $this->db->con->query($query);

            $resultArray = array();
            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $resultArray[] = $item;
            }
            return $resultArray;
        }
    }

    public function getByOrderId($id)
    {
        if (isset($id)) {
            $result = $this->db->con->query("SELECT * FROM order_table, order_items , product
            WHERE order_table.order_id=$id
            AND order_table.order_id =  order_items.order_id 
            AND order_items.item_id = product.item_id");
            // $result = mysqli_query($conn, $sql);

            $resultArray = array();

            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $resultArray[] = $item;
            }

            return $resultArray;
        }
    }

    public function sendConfirmationEmail($params)
    {
        $mail = new PHPMailer(true);

        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "ammarabdulaziz99@gmail.com";
        $mail->Password = '';
        $mail->Port = 465; //587
        $mail->SMTPSecure = "ssl"; //tls

        //Email Settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isHTML(true);
        $mail->setFrom($_SESSION['email'], 'Ammar Abdul Aziz');
        $mail->addAddress(address: $_SESSION['email']);
        $mail->Subject = 'New Subject';
        $mail->Body = 'Your order from Applabshop has been confirmed.';

        if ($mail->send()) return true;
        else return false;
    }
}
