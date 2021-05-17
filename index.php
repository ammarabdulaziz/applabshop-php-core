<?php

// $conn = mysqli_connect('localhost', 'root', '', 'applabshop');

// if (!$conn) echo 'Connection err: ' . mysqli_connect_error();

require('functions.php');

$products = $Product->getData();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['cart_submit'])) {
        $Cart->addToCart($_POST['user_id'], $_POST['item_id']);
    }
}

?>

<!DOCTYPE html>

<?php include('templates/header.php') ?>

<section class="container">
    <div class="page-header mt-5">
        <h3 id="forms">Products</h3>
    </div>
    <div class="container">
        <div class="row d-flex justify-content-between">
            <?php foreach ($products as $product) { ?>
                <div class="card mt-4" style="width: 18rem;">
                    <img class="card-img-top" src="<?php echo $product['image'] ?>" alt="1.PNG">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product['name'] ?? 'Unkown' ?></h5>
                        <p class="card-text">
                            <?php
                            $specsArr = explode(',', $product['specs']);
                            foreach ($specsArr as $spec) { ?>
                                <li><?php echo $spec ?></li>
                            <?php }
                            ?>
                        </p>
                        <h4><?php echo $product['price'] . ' Rs' ?? 'Unkown' ?></h4>
                        <form method="post">
                            <input type="hidden" name="item_id" value="<?php echo $product['item_id'] ?? '1'; ?>">
                            <input type="hidden" name="user_id" value="<?php echo 1; ?>">
                            <?php
                            if (in_array($product['item_id'], $Cart->getCartId($Product->getData(table: 'cart')) ?? [])) {
                                echo '<button type="submit" disabled name="" class="btn btn-dark disabled">Added to Cart</button>';
                            } else {
                                echo '<button type="submit" name="cart_submit" class="btn btn-info">Add to Cart</button>';
                            }
                            ?>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>




<?php include('templates/footer.php') ?>

</html>