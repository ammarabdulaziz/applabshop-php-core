<?php

// $conn = mysqli_connect('localhost', 'root', '', 'applabshop');

// if (!$conn) echo 'Connection err: ' . mysqli_connect_error();

require('functions.php');

$products = $Product->getData();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete-cart-submit'])) {
        $deletedrecord = $Cart->deleteCart($_POST['item_id']);
    }
}

?>

<!DOCTYPE html>

<style>
    .table td.fit,
    .table th.fit {
        white-space: nowrap;
        width: 1%;
    }

    .qtyVal {
        color: #777 !important;
        font-weight: 200 !important;
    }
</style>

<?php include('templates/header.php') ?>

<section class="container">
    <div class="m-5">
        <div class="page-header">
            <h3>Cart</h3>
        </div>

        <div class="row">
            <div class="col-8">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="fit" scope="col">Title</th>
                            <th class="fit" scope="col">Qty</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Image</th>
                            <th scope="col">Price</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($Product->getData('cart') as $item) :
                            $cartItem = $Product->getProduct($item['item_id']);
                            $subTotal[] = array_map(function ($product) use ($item) {
                        ?>
                                <tr>
                                    <th class="fit align-middle" scope="row"><?php echo $product['name'] ?></th>
                                    <th class="fit align-middle">

                                        <button data-id="<?php echo $product['item_id'] ?? '0'; ?>" data-cartid="<?php echo $item['cart_id'] ?>" type=" button" class="btn btn-sm btn-success btnDec <?php if ($item['qty'] == 1) echo 'disabled' ?>" value="<?php echo $item['qty'] ?? '1'; ?>">-</button>

                                        <span data-id="<?php echo $product['item_id'] ?? '0'; ?>" class="badge bg-light qtyVal p-2"> <?php echo $item['qty'] ?? '1'; ?>
                                        </span>

                                        <button data-id="<?php echo $product['item_id'] ?? '0'; ?>" data-cartid="<?php echo $item['cart_id'] ?>" type="button" class="btn btn-sm btn-success btnInc" value="<?php echo $item['qty'] ?? '1'; ?>">+</button>

                                    </th>
                                    <td class="align-middle"><?php echo $product['brand'] ?></td>
                                    <td class="align-middle"><img src="<?php echo $product['image'] ?? "./products/1.png" ?>" style="height: 50px;" alt="cart1" class="img-fluid"></td>
                                    <td class="align-middle">
                                        <span data-id="<?php echo $product['item_id'] ?? '0'; ?>" class="productPrice"><?php echo $product['price'] * $item['qty'] ?>
                                        </span> Rs
                                    </td>
                                    <td class="align-middle">
                                        <form method="post">
                                            <input type="hidden" name="item_id" value="<?php echo $product['item_id'] ?? 0; ?>">
                                            <button type="submit" name="delete-cart-submit" class="btn btn-sm btn-danger align-middle">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                        <?php
                                return [$product['price'], $item['qty']];
                            }, $cartItem); // closing array_map function
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 pt-1 pb-1">Checkout</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">Subtotal - <b><?php echo isset($subTotal) ? count($Product->getData(table: 'cart')) : 0; ?></b> Items: <span class="text-success subTotal">
                                <?php echo isset($subTotal) ? $Cart->getSum($subTotal) : 0; ?></span><span class="text-success"> Rs</span>
                        </h6>
                        <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
                        <a href="#" class="btn btn-sm btn-primary mt-2">Proceed to Buy</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<?php include('templates/footer.php') ?>

</html>