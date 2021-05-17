<?php

class User
{
    public $db = null;

    public function __construct(DBController $db)
    {
        if (!isset($db->con)) return null;
        $this->db = $db;
    }

    public function createUser($name, $username, $password, $errors)
    {
        $sql = "SELECT * FROM user WHERE username='{$username}'";
        $result = mysqli_query($this->db->con, $sql);

        if (!$result->num_rows > 0) {
            $query = "INSERT INTO user (username, name, password) VALUES ('$username', '$name', '$password')";
            $result = $this->db->con->query($query);
            if ($result) {
                $_SESSION["username"] = $username;
                header("Location:" . 'index.php');
                $name = "";
                $username = "";
            } else {
                echo "<script>alert('Woops! Something Wrong Went.')</script>";
            }
        } else {
            // echo "<script>alert('Username Already Exists.')</script>";
            return $errors['username'] = 'This username already exists.';
        }
    }

    public function loginUser($username, $password)
    {
        $sql = "SELECT * FROM user WHERE username='{$username}' AND password='{$password}'";
        $result = mysqli_query($this->db->con, $sql);

        if ($result->num_rows > 0) {
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
        } else {
            return false;
        }
    }
}
