<?php

// $conn = mysqli_connect('localhost', 'root', '', 'applabshop');

// if (!$conn) echo 'Connection err: ' . mysqli_connect_error();

require('functions.php');

$products = $product->getData();

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
                    <img class="card-img-top" src="<?php echo $product['image'] ?? 'https://images-na.ssl-images-amazon.com/images/I/81AqwYyZjzL._AC_SL1500_.jpg' ?>" alt="Card image cap">
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
                        <a href="#" class="btn btn-primary">Add to cart</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>




<?php include('templates/footer.php') ?>

</html>