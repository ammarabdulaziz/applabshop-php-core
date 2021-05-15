<?php

class Cart
{
    public $db = null;

    public function __construct(DBController $db)
    {
        if (!isset($db->con)) return null;
        $this->db = $db;
    }

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

    // calculate sub total
    public function getSum($arr)
    {
        if (isset($arr)) {
            $sum = 0;
            foreach ($arr as $item) {
                $sum += floatval($item[0]);
            }
            return sprintf('%.2f', $sum);
        }
    }

    // delete cart item
    public function deleteCart($item_id = null, $table = 'cart')
    {
        if ($item_id != null) {
            $result = $this->db->con->query("DELETE FROM {$table} WHERE item_id={$item_id}");
            if ($result) {
                header("Location:" . $_SERVER['PHP_SELF']);
            }
            return $result;
        }
    }
}
