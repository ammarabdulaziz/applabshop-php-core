<?php

require_once(dirname(__DIR__) . '/../database/Product.php');

class productController
{
    public $Product;
    public function __construct()
    {
        $this->Product = new Product();
    }

    public function read()
    {
        $products = $this->Product->getData();

        if (count($products) != 0) {
            http_response_code(200);
            return print_r(json_encode($products));
        }
        http_response_code(404);
        return print_r(json_encode(['message' => 'No products found']));
    }

    public function readOne()
    {
        if (!isset($_GET['id'])) return print_r(json_encode(['message' => 'Invalid pramater key']));
        if (!is_numeric($_GET['id'])) return print_r(json_encode(['message' => 'Id should be numeric']));

        $products = $this->Product->getProduct($_GET['id']);

        if (count($products) != 0) {
            http_response_code(200);
            return print_r(json_encode($products));
        }

        http_response_code(404);
        return print_r(json_encode(['message' => 'No products found']));
    }
}
