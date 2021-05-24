<?php if (session_status() == PHP_SESSION_NONE) session_start(); ?>

<?php include('../views/header.php') ?>
<style>
    .new-card-body-list {
        font-size: 14px;
        color: #707070 !important;
    }

    .new-card-comp {
        padding-left: 7px;
    }
</style>
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
                            <?php $specsArr = explode(',', $product['specs']);
                            foreach ($specsArr as $spec) { ?>
                        <div class="d-flex new-card-body-list align-items-center">
                            <span><i class="fa fa-mobile text-secondary" aria-hidden="true"></i></span>
                            <p class="mb-0 new-card-comp"><?php echo $spec ?></p>
                        </div>
                    <?php } ?>
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


<?php include('../views/footer.php') ?>