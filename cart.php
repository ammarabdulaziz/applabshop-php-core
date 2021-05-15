<?php

// $conn = mysqli_connect('localhost', 'root', '', 'applabshop');

// if (!$conn) echo 'Connection err: ' . mysqli_connect_error();

require('functions.php');

$products = $product->getData();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['cart_submit'])) {
        $cart->addToCart($_POST['user_id'], $_POST['item_id']);
    }
}

?>

<!DOCTYPE html>

<?php include('templates/header.php') ?>

<section class="container">
    <div class="m-5">
        <div class="page-header">
            <h3>Cart</h3>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Image</th>
                    <th scope="col">Price</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($product->getData('cart') as $item) :
                    $cart = $product->getProduct($item['item_id']);
                    $subTotal[] = array_map(function ($item) {
                ?>
                        <tr>
                            <th scope="row"><?php echo $item['name'] ?></th>
                            <td><?php echo $item['brand'] ?></td>
                            <td><img src="<?php echo $item['item_image'] ?? "./products/1.png" ?>" style="height: 10px;" alt="cart1" class="img-fluid"></td>
                            <td><?php echo $item['price'] ?></td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                <?php
                        // return $item['price'];
                    }, $cart); // closing array_map function
                endforeach;
                ?>
            </tbody>
        </table>
    </div>

</section>

<?php include('templates/footer.php') ?>

</html>