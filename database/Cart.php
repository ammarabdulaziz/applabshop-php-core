<?php

class Cart
{
    public $db = null;

    public function __construct(DBController $db)
    {
        if (!isset($db->con)) return null;
        $this->db = $db;
    }

    // Insert into cart table
    // public function insertIntoCart($params = null, $table = "cart")
    // {
    //     if ($this->db->con != null) {
    //         if ($params != null) {
    //             // Insert into cart(user_id) values (0)
    //             // get table columns
    //             $columns = implode(',', array_keys($params));
    //             $values = implode(',', array_values($params));

    //             $query = sprintf("INSERT INTO %s(%s) VALUES(%s)", $table, $columns, $values);

    //             $result = $this->db->con->query($query);
    //             return $result;
    //         }
    //     }
    // }

    // to get user_id and item_id and insert into cart table
    public function addToCart($userid, $itemid, $table = "cart")
    {
        if (isset($userid) && isset($itemid)) {
            $params = array("user_id" => $userid, "item_id" => $itemid);

            // $result = $this->insertIntoCart($params);
            $columns = implode(',', array_keys($params));
            $values = implode(',', array_values($params));

            $query = sprintf("INSERT INTO %s(%s) VALUES(%s)", $table, $columns, $values);

            $result = $this->db->con->query($query);
            if ($result) header("Location: " . $_SERVER['PHP_SELF']);
        }
    }
}
