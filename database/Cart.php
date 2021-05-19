<?php

class Cart
{
    public $db = null;

    public function __construct(DBController $db)
    {
        if (!isset($db->con)) return null;
        $this->db = $db;
    }

    public function getCart($user_id, $table = 'cart')
    {
        if (!isset($_SESSION['user_id'])) return $_SESSION['cart'] ?? [];

        $result = $this->db->con->query("SELECT * FROM {$table} WHERE user_id = {$user_id}");

        $resultArray = array();
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArray[] = $item;
        }

        return $resultArray;
    }

    // to get user_id and item_id and insert into cart table
    public function addToCart($user_id, $item_id, $table = "cart")
    {
        // If guest user
        if (!isset($_SESSION['user_id'])) {
            $cart = ['cart_id' => '', 'item_id' => $item_id, 'qty' => 1];
            $_SESSION['cart'][] = $cart;
            return $cart;
        }


        if (isset($user_id) && isset($item_id)) {
            // var_dump($user_id, $item_id);
            // exit;
            $params = array("user_id" => $user_id, "item_id" => $item_id);

            $columns = implode(',', array_keys($params));
            $values = implode(',', array_values($params));

            $query = sprintf("INSERT INTO %s(%s) VALUES(%s)", $table, $columns, $values);

            $result = $this->db->con->query($query);
            return $result;
            // if ($result) header("Location: " . $_SERVER['PHP_SELF']);

        }
    }


    // $index = array_search($item_id, array_column($_SESSION['cart'], 'item_id'));
    // // unset($_SESSION['cart'][$index]);
    // array_splice($_SESSION['cart'], $index, 1);
    // var_export($_SESSION['cart']);
    // $_SESSION['cart'] = array_values($_SESSION['cart']);

    // calculate sub total
    public function getSum($arr)
    {
        if (isset($arr)) {
            $sum = 0;
            foreach ($arr as $item) {
                $sum += floatval($item[0][0]) * $item[0][1];
            }
            return sprintf('%.2f', $sum);
        }
    }

    // delete cart item
    public function deleteCart($user_id, $item_id, $table = 'cart')
    {
        if (session_status() == PHP_SESSION_NONE) session_start();

        if (!isset($_SESSION['user_id'])) {
            $index = array_search($item_id, array_column($_SESSION['cart'], 'item_id'));
            $cart = $_SESSION['cart'];
            unset($cart[$index]);
            $_SESSION['cart'] = array_values($cart);
            return;
        }

        if ($item_id != null) {
            $result = $this->db->con->query("DELETE FROM {$table} WHERE item_id={$item_id} and user_id={$user_id}");
            if ($result) {
                header("Location:" . $_SERVER['PHP_SELF']);
            }
            return $result;
        }
        print_r($_SESSION['cart']);
    }

    // get item_id of shopping cart list
    public function getCartId($cartArray = null, $key = "item_id")
    {
        if ($cartArray != null) {
            $cart_id = array_map(function ($value) use ($key) {
                return $value[$key];
            }, $cartArray);
            return $cart_id;
        }
    }

    public function updateQty($cart_id, $count, $item_id, $table = 'cart')
    {
        if (isset($_SESSION['user_id'])) {
            $query = sprintf("UPDATE %s SET qty = qty + %d WHERE cart_id = %s", $table, intval($count), $cart_id);

            $result = $this->db->con->query($query);
            return $result;
        } else {
            $index = array_search($item_id, array_column($_SESSION['cart'], 'item_id'));
            $cart = $_SESSION['cart'];
            $cart[$index]['qty'] = $cart[$index]['qty'] + $count;
            $_SESSION['cart'] = $cart;
            return;
        }
    }
}
