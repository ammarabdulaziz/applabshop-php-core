<?php

if (session_status() == PHP_SESSION_NONE) session_start();

$products = $Product->getData();

?>

<!DOCTYPE html>

<section class="container">
    <div class="page-header mt-5">
        <h3 id="forms">Products</h3>
    </div>
    <div class="container">
        <div class="row d-flex justify-content-between">
            <?php foreach ($products as $product) { ?>
                <div class="card mt-4" style="width: 18rem;">
                    <img class="card-img-top" src="<?php echo $product['image'] ?>" alt="public/images/1.png">
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
                        <h4><?php echo $product['price'] . ' Qr' ?? 'Unkown' ?></h4>
                        <form method="post">
                            <!-- <input type="hidden" name="item_id" value="<?php echo $product['item_id'] ?? '1'; ?>"> -->
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?? null; ?>">
                            <?php
                            if (in_array($product['item_id'], $Cart->getCartId($Cart->getCart()) ?? [])) {
                                echo '<button type="submit" disabled name="" class="btn btn-dark disabled">Added to Cart</button>';
                            } else {
                                echo '<button name="cart_submit" data-item="' . $product['item_id'] . '" class="btn btn-info">Add to Cart</button>';
                            }
                            ?>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>


</html>