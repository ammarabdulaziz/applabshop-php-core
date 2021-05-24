<?php include('../views/header.php'); ?>


<style>
    .new-card {
        margin: 0em 10em;
    }

    .new-card-head p {
        font-size: 13px;
        margin-bottom: 0px;
    }

    .new-card-head .new-card-comp {
        padding-left: 5em;
    }

    .new-card-body .new-card-comp {
        padding-left: 1em;
    }

    .new-card-img {
        width: 100px;
        height: 120px;
        object-fit: cover;
        box-shadow: rgba(0, 0, 0, 0.03) 0px 10px 15px -10px, rgba(0, 0, 0, 0.05) 0px 4px 6px -2px;
    }

    .new-card-body-btn {
        min-width: 200px;
        font-size: 15px !important;
    }

    .new-card-body-title {
        font-weight: 500;
        font-size: 18px;
    }

    .new-card-body-list {
        font-size: 12px;
        color: #707070 !important;
    }

    .new-card-body-ftrs h6 {
        font-size: 14px;
    }
</style>

<section class="container">
    <div class="mt-5 new-card">
        <div class="page-header">
            <h3>Your Orders</h3>
        </div>
        <?php foreach ($myOrders as $order) { ?>
            <?php
            $new_array = array_filter($myOrdersItems, function ($obj) use ($order) {
                if ($obj['order_id'] == $order['order_id']) return $obj;
            });
            ?>
            <div class="list-group mb-4 mt-3">
                <div class="list-group-item flex-column align-items-start active text-primary p-3">
                    <div class="d-flex new-card-head justify-content-between">
                        <div class="d-flex">
                            <div>
                                <p class="text-secondary">ORDER PLACED</p>
                                <p class="pt-1"><?php $date = new DateTime($order['createdAt']);
                                                echo $date->format('j F o') ?></p>
                            </div>
                            <div class="new-card-comp">
                                <p class="text-secondary">QTY</p>
                                <p class="pt-1"><?php echo count($new_array) ?></p>
                            </div>
                            <div class="new-card-comp">
                                <p class="text-secondary">TOTAL</p>
                                <p class="pt-1"><?php echo $order['order_price'] ?> QR</p>
                            </div>
                            <div class="new-card-comp">
                                <p class="text-secondary">SHIPPED TO</p>
                                <p class="pt-1"><?php echo $order['name'] ?></p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex align-items-end flex-column">
                                <p class="align-right text-secondary">ORDER ID</p>
                                <p class="ml-auto pt-1"># 000 - 0000 - <?php echo $order['order_id'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <?php foreach ($new_array as $item) { ?>
                    <div class="list-group-item flex-column align-items-start new-card-body p-3">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex col-md-5">
                                <img class="new-card-img" src="<?php echo $item['image'] ?>" alt="" />
                                <div class="new-card-comp">
                                    <h6 class="mb-0 new-card-body-title"><?php echo $item['name'] ?></h6>
                                    <h6 class="text-secondary pt-1"><?php echo $item['brand'] ?></h6>
                                    <?php
                                    $specsArr = explode(',', $item['specs']);
                                    foreach ($specsArr as $spec) { ?>
                                        <div class="d-flex new-card-body-list">
                                            <span><i class="fa fa-mobile text-secondary" aria-hidden="true"></i></span>
                                            <p class="mb-0 new-card-comp"><?php echo $spec ?></p>
                                        </div>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                            <div class="d-flex col-md-3 new-card-body-ftrs">
                                <div>
                                    <h6 class="text-secondary">QTY</h6>
                                    <h6><?php echo $item['qty'] ?></h6>
                                </div>
                                <div style="padding-left: 5em;">
                                    <h6 class="text-secondary">PRICE</h6>
                                    <h6><?php echo $item['item_price'] ?> Qr</h6>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="d-flex align-items-end flex-column">
                                    <h6>Subtotal : <?php echo $item['qty'] * $item['item_price'] ?> Qr</h6>
                                    <a href="<?php echo '/applabshop/user/products/index.php' ?>" class="btn btn-block btn-primary new-card-body-btn p-1">Buy Again</a>
                                    <button class="btn btn-block btn-secondary new-card-body-btn mt-2 p-1">Invoice</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
        <?php if (count($myOrders) == 0) { ?>
            <div id="cart-empty">
                <div class="d-flex justify-content-center">
                    <img src="../../public/static/empty_cart.png" height="250px" width="auto" alt="">
                </div>
                <div class="d-flex justify-content-center mt-2">
                    <h4>Your don't have any orders</h4>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="/applabshop/user/products/index.php" class="btn btn-success">Shop Now</a>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<?php include('../views/footer.php') ?>

</html>