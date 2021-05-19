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
            // $result = mysqli_query($conn, $sql);

            $resultArray = array();

            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $resultArray[] = $item;
            }

            return $resultArray;
        }
    }

    public function addProduct($name, $brand, $price, $specs, $path, $table = 'product')
    {
        if (isset($name) && isset($brand) && isset($price) && isset($specs)) {
            $params = [
                "name" => $name,
                "brand" => $brand,
                "image" => $path,
                "specs" => $specs,
                "price" => $price
            ];

            $columns = implode(',', array_keys($params));
            $values = "'" . implode("','", array_values($params)) . "'";

            $query = sprintf("INSERT INTO %s(%s) VALUES(%s)", $table, $columns, $values);
            // $query = "INSERT INTO product(name, brand, price, image, specs) VALUES('{$name}', '{$brand}', '{$price}', '{.png}', '{$specs}')";
            // $query = "INSERT INTO product(name, brand, price, image, specs) VALUES('a','b',10, '.png', 'c')";

            $result = $this->db->con->query($query);
            // var_dump(mysqli_error($this->db->con));
            // var_dump($columns, $values);
            // exit;
            return $result;
        }
    }
}
