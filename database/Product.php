<?php

class Product
{
    public $db = null;

    public function __construct(DBController $db)
    {
        if (!isset($db->con)) return null;
        $this->db = $db;
    }

    // Fetch data
    public function getData($table = 'product')
    {
        $result = $this->db->con->query("SELECT * FROM {$table}");

        $resultArray = array();
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArray[] = $item;
        }

        return $resultArray;
    }

    // get product using item id
    public function getProduct($item_id = null, $table = 'product')
    {
        if (isset($item_id)) {
            $result = $this->db->con->query("SELECT * FROM {$table} WHERE item_id={$item_id}");

            $resultArray = array();

            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $resultArray[] = $item;
            }

            return $resultArray;
        }
    }
}


// Array ( [0] => Array ( [item_id] => 1 [brand] => Samsung [name] => Samsung Galaxy 10 [price] => 152.00 [image] => 1.png [specs] => abc,def,geh [item_register] => 2020-03-28 11:08:57 ) [1] => Array ( [item_id] => 2 [brand] => Redmi [name] => Redmi Note 7 [price] => 122.00 [image] => 2.png [specs] => abc,def,geh [item_register] => 2020-03-28 11:08:57 ) [2] => Array ( [item_id] => 3 [brand] => Redmi [name] => Redmi Note 6 [price] => 122.00 [image] => 3.png [specs] => abc,def,geh [item_register] => 2020-03-28 11:08:57 ) [3] => Array ( [item_id] => 4 [brand] => Redmi [name] => Redmi Note 5 [price] => 122.00 [image] => 4.png [specs] => abc,def,geh [item_register] => 2020-03-28 11:08:57 ) [4] => Array ( [item_id] => 5 [brand] => Redmi [name] => Redmi Note 4 [price] => 122.00 [image] => 5.png [specs] => abc,def,geh [item_register] => 2020-03-28 11:08:57 ) [5] => Array ( [item_id] => 6 [brand] => Redmi [name] => Redmi Note 8 [price] => 122.00 [image] => 6.png [specs] => abc,def,geh [item_register] => 2020-03-28 11:08:57 ) [6] => Array ( [item_id] => 7 [brand] => Redmi [name] => Redmi Note 9 [price] => 122.00 [image] => 8.png [specs] => abc,def,geh [item_register] => 2020-03-28 11:08:57 ) [7] => Array ( [item_id] => 8 [brand] => Redmi [name] => Redmi Note [price] => 122.00 [image] => 10.png [specs] => abc,def,geh [item_register] => 2020-03-28 11:08:57 ) [8] => Array ( [item_id] => 9 [brand] => Samsung [name] => Samsung Galaxy S6 [price] => 152.00 [image] => 11.png [specs] => abc,def,geh [item_register] => 2020-03-28 11:08:57 ) [9] => Array ( [item_id] => 10 [brand] => Samsung [name] => Samsung Galaxy S7 [price] => 152.00 [image] => 12.png [specs] => abc,def,geh [item_register] => 2020-03-28 11:08:57 ) [10] => Array ( [item_id] => 11 [brand] => Apple [name] => Apple iPhone 5 [price] => 152.00 [image] => 13.png [specs] => abc,def,geh [item_register] => 2020-03-28 11:08:57 ) [11] => Array ( [item_id] => 12 [brand] => Apple [name] => Apple iPhone 6 [price] => 152.00 [image] => 14.png [specs] => abc,def,geh [item_register] => 2020-03-28 11:08:57 ) [12] => Array ( [item_id] => 13 [brand] => Apple [name] => Apple iPhone 7 [price] => 152.00 [image] => 15.png [specs] => abc,def,geh [item_register] => 2020-03-28 11:08:57 ) )