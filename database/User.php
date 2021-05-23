<?php

class User
{
    public $db = null;

    public function __construct(DBController $db)
    {
        if (!isset($db->con)) return null;
        $this->db = $db;
    }

    public function createUser($name, $username, $password, $checkout, $errors)
    {
        $sql = "SELECT * FROM user WHERE username='{$username}'";
        $result = mysqli_query($this->db->con, $sql);

        if (!$result->num_rows > 0) {
            $query = "INSERT INTO user (username, name, password) VALUES ('$username', '$name', '$password')";
            $result = $this->db->con->query($query);
            if ($result) {
                $last_id = mysqli_insert_id($this->db->con);
                $_SESSION["user_id"] = $last_id;

                if (isset($checkout)) {
                    foreach ($_SESSION['cart'] as $cart_item) {
                        $user_id = $_SESSION['user_id'];
                        $item_id = $cart_item['item_id'];
                        $qty = $cart_item['qty'];
                        $createdAt = $cart_item['createdAt'];

                        $query = "INSERT INTO cart(user_id, item_id, qty, createdAt) VALUES ('{$user_id}', '{$item_id}','{$qty}','{$createdAt}')";

                        $result = $this->db->con->query($query);
                        if ($result) {
                            unset($_SESSION['cart']);
                            header("Location: cart.php");
                        }
                    }
                } else {
                    header("Location: index.php");
                }
                $name = "";
                $username = "";
            } else {
                echo "<script>alert('Woops! Something Wrong Went.')</script>";
            }
        } else {
            return $errors['username'] = 'This username already exists.';
        }
    }

    public function loginUser($username, $password, $checkout, $orders)
    {
        $sql = "SELECT * FROM user WHERE username='{$username}' AND password='{$password}'";
        $result = mysqli_query($this->db->con, $sql);

        if ($result->num_rows > 0) {
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

            if ($user['type'] == 'admin') {
                $_SESSION['admin'] = $user['user_id'];
                return header("Location: admin.php");
            }

            $_SESSION['user_id'] = $user['user_id'];

            if (isset($checkout)) {
                foreach ($_SESSION['cart'] as $cart_item) {
                    $user_id = $_SESSION['user_id'];
                    $item_id = $cart_item['item_id'];
                    $qty = $cart_item['qty'];
                    $createdAt = $cart_item['createdAt'];

                    $query = "SELECT * FROM cart WHERE user_id={$user_id} AND item_id={$item_id}";
                    $result = $this->db->con->query($query);

                    if ($result->num_rows > 0) {
                        $resultArray = array();

                        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            $resultArray[] = $item;
                        }
                        $newQty = (int)$resultArray[0]['qty'] + $qty;

                        $query = "UPDATE cart SET qty={$newQty} where user_id={$_SESSION['user_id']} and item_id={$item_id}";

                        $result = $this->db->con->query($query);
                    } else {
                        $query = "INSERT INTO cart(user_id, item_id, qty, createdAt) VALUES ('{$user_id}', '{$item_id}','{$qty}','{$createdAt}')";

                        $result = $this->db->con->query($query);
                    }
                }

                unset($_SESSION['cart']);
                header("Location: cart.php");
            } else if (isset($orders)) {
                header("Location: orders.php");
            } else {
                header("Location: index.php");
            }
        } else {
            return false;
        }
    }
}
