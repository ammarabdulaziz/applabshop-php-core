<?php

require_once(dirname(__DIR__) . '/../database/Product.php');

class productController
{
    public $Product;
    public function __construct()
    {
        $this->Product = new Product();
    }

    public function index()
    {
        $products = $this->Product->getData();
        return include('../views/products/list.php');
    }

    public function create()
    {
        return include('../views/products/add.php');
    }

    public function store()
    {
        if (isset($_POST['submit'])) {

            // Check name 
            $errors = array('name' => '', 'brand' => '', 'price' => '', 'specs' => '', 'image' => '');
            if (empty($_POST['name'])) {
                $errors['name'] = 'Name is empty <br>';
            } else {
                $name = $_POST['name'];
            }

            // Check brand
            if (empty($_POST['brand'])) {
                $errors['brand'] = 'Brand is empty <br>';
            } else {
                $brand = $_POST['brand'];
            }

            // Check price
            if (empty($_POST['price'])) {
                $errors['price'] = 'Price is empty <br>';
            } else {
                $price = $_POST['price'];
            }

            // Check specs
            if (empty($_POST['specs'])) {
                $errors['specs'] = 'Enter atleast one specification <br>';
            } else {
                $specs = $_POST['specs'];
            }

            // Check image
            if (empty($_FILES['image']['tmp_name'])) {
                $errors['image'] = 'Image is empty <br>';
            } else {
                $file_name = time();
                $file_size = $_FILES['image']['size'];
                $file_tmp = $_FILES['image']['tmp_name'];
                $file_type = $_FILES['image']['type'];
                $file_props_arr = explode('.', $_FILES['image']['name']);
                $file_ext = strtolower(end($file_props_arr));

                $extensions = array("jpeg", "jpg", "png");
                // var_dump($file_ext);
                // exit;

                if (in_array($file_ext, $extensions) === false) {
                    $errors['image'] = "Extension not allowed, please choose a JPEG or PNG file <br>";
                }

                if ($file_size > 2097152) {
                    $errors['image'] = 'File size must be less than 2 MB  <br>';
                }
            }

            if (!array_filter($errors)) {
                $path = "../../public/images/" . $file_name . '.' . $file_ext;
                $result = $this->Product->addProduct($_POST['name'], $_POST['brand'], $_POST['price'], $_POST['specs'], $path);
                if (isset($result)) {
                    move_uploaded_file($file_tmp, $path);
                    header('Location: ./index.php');
                }
            } else {
                return include('../views/products/add.php');
            }
        }
    }

    public function update()
    {
        $errors = array('name' => '', 'brand' => '', 'price' => '', 'specs' => '', 'image' => '');
        $product = $this->Product->getProduct($_GET['id']);

        $item_id = $product[0]['item_id'];
        $name = $product[0]['name'];
        $brand = $product[0]['brand'];
        $price = $product[0]['price'];
        $specs = $product[0]['specs'];
        $image = $product[0]['image'];
        return include('../views/products/edit.php');
    }

    public function change()
    {

        if (isset($_POST['submit'])) {
            // Check name 
            $errors = array('name' => '', 'brand' => '', 'price' => '', 'specs' => '', 'image' => '');
            if (empty($_POST['name'])) {
                $errors['name'] = 'Name is empty <br>';
            } else {
                $name = $_POST['name'];
            }

            // Check brand
            if (empty($_POST['brand'])) {
                $errors['brand'] = 'Brand is empty <br>';
            } else {
                $brand = $_POST['brand'];
            }

            // Check price
            if (empty($_POST['price'])) {
                $errors['price'] = 'Price is empty <br>';
            } else {
                $price = $_POST['price'];
            }

            // Check specs
            if (empty($_POST['specs'])) {
                $errors['specs'] = 'Enter atleast one specification <br>';
            } else {
                $specs = $_POST['specs'];
            }

            // Check image
            $path = $_POST['image'];
            $image = $_POST['image'];
            if (!empty($_FILES['image']['tmp_name'])) {
                $file_name = time();
                $file_size = $_FILES['image']['size'];
                $file_tmp = $_FILES['image']['tmp_name'];
                $file_type = $_FILES['image']['type'];
                $file_props_arr = explode('.', $_FILES['image']['name']);
                $file_ext = strtolower(end($file_props_arr));

                $extensions = array("jpeg", "jpg", "png");

                if (in_array($file_ext, $extensions) === false) $errors['image'] = "Extension not allowed, please choose a JPEG or PNG file <br>";
                if ($file_size > 2097152) $errors['image'] = 'File size must be less than 2 MB  <br>';

                unlink($path);
                $path = "../../public/images/" . $file_name . '.' . $file_ext;
            }

            if (!array_filter($errors)) {
                $result = $this->Product->editProduct($_POST['item_id'], $_POST['name'], $_POST['brand'], $_POST['price'], $_POST['specs'], $path);
                if (isset($result)) {
                    move_uploaded_file($file_tmp, $path);
                    header('Location: ./index.php');
                }
            } else {
                return include('../views/products/edit.php');
            }
        }
    }

    public function delete()
    {
        $result = $this->Product->deleteProduct($_POST['id'], $_POST['image']);
        echo json_encode($result);
    }
}
