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
                            $subTotal[] = array_map(function ($item) {
                        ?>
                                <tr>
                                    <th class="fit align-middle" scope="row"><?php echo $item['name'] ?></th>
                                    <th class="fit align-middle">
                                        <button type="button" class="btn btn-sm btn-success">-</button>
                                        <span class="badge bg-light p-2" style="color: #777 !important; font-weight: 200 !important;">10</span>
                                        <button type="button" class="btn btn-sm btn-success">+</button>
                                    </th>
                                    <td class="align-middle"><?php echo $item['brand'] ?></td>
                                    <td class="align-middle"><img src="<?php echo $item['item_image'] ?? "./products/1.png" ?>" style="height: 10px;" alt="cart1" class="img-fluid"></td>
                                    <td class="align-middle"><?php echo $item['price'] ?></td>
                                    <td class="align-middle">
                                        <form method="post">
                                            <input type="hidden" name="item_id" value="<?php echo $item['item_id'] ?? 0; ?>">
                                            <button type="submit" name="delete-cart-submit" class="btn btn-sm btn-danger align-middle">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                        <?php
                                return $item['price'];
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
                        <h6 class="card-title">Subtotal - <b><?php echo isset($subTotal) ? count($Product->getData(table: 'cart')) : 0; ?></b> Items: <span class="text-success">
                                <?php echo isset($subTotal) ? $Cart->getSum($subTotal) : 0; ?> Rs</span>
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