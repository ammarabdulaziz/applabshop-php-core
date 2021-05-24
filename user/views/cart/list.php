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

    .closed {
        display: none;
    }

    .show {
        display: block;
    }
</style>

<?php
include('../views/header.php');

// if (isset($_GET['checkout']) && isset($_SESSION['user_id']) && count($Cart->getCart()) != 0) {
//     $Order->makeOrder();
// };

?>

<section class="container">
    <div class="m-5">
        <div class="page-header">
            <h3>Cart</h3>
        </div>
        <div class="row">
            <div class="col-8">
                <table id="cart-table" class="table closed <?php if (count($Cart->getCart())) echo 'show' ?>">
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
                        foreach ($Cart->getCart() as $item) :
                            $cartItem = $Product->getProduct($item['item_id']);
                            $subTotal[] = array_map(function ($product) use ($item) {
                        ?>
                                <tr data-id="<?php echo $product['item_id'] ?? '0'; ?>">
                                    <th class="fit align-middle" scope="row"><?php echo $product['name'] ?></th>
                                    <th class="fit align-middle">

                                        <button data-id="<?php echo $product['item_id'] ?? '0'; ?>" data-cartid="<?php echo $item['cart_id'] ?>" type=" button" class="btn btn-sm btn-success btnDec <?php if ($item['qty'] == 1) echo 'disabled' ?>" value="<?php echo $item['qty'] ?? '1'; ?>">-</button>

                                        <span data-id="<?php echo $product['item_id'] ?? '0'; ?>" class="badge bg-light qtyVal p-2"> <?php echo $item['qty'] ?? '1'; ?>
                                        </span>

                                        <button data-id="<?php echo $product['item_id'] ?? '0'; ?>" data-cartid="<?php echo $item['cart_id'] ?>" type="button" class="btn btn-sm btn-success btnInc" value="<?php echo $item['qty'] ?? '1'; ?>">+</button>

                                    </th>
                                    <td class="align-middle"><?php echo $product['brand'] ?></td>
                                    <td class="align-middle"><img src="<?php echo $product['image'] ?>" style="height: 50px;" alt="public/images/1.png" class="img-fluid"></td>
                                    <td class="align-middle">
                                        <span data-id="<?php echo $product['item_id'] ?? '0'; ?>" class="productPrice"><?php echo $product['price'] * $item['qty'] ?>
                                        </span> Qr
                                    </td>
                                    <td class="align-middle">
                                        <form method="post">
                                            <input type="hidden" name="item_id" value="<?php echo $product['item_id'] ?? null; ?>">
                                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?? null; ?>">
                                            <button name="delete-cart-submit" data-item="<?php echo $product['item_id'] ?? '0'; ?>" class="btn btn-sm btn-danger align-middle mt-3">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                        <?php
                                return [$product['price'], $item['qty'], $item['item_id']];
                            }, $cartItem); // closing array_map function
                        endforeach;
                        ?>
                    </tbody>
                </table>
                <div id="cart-empty" class="<?php if (count($Cart->getCart()) !== 0) echo 'closed' ?>">
                    <div class="d-flex justify-content-center">
                        <img src="../../public/static/empty_cart.png" height="250px" width="auto" alt="">
                    </div>
                    <div class="d-flex justify-content-center mt-2">
                        <h4>Your cart is empty</h4>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="/applabshop/user/products/index.php" class="btn btn-success">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="mb-0 pt-1 pb-1">Payment Type</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-check pb-1">
                            <input class="form-check-input" type="radio" name="exampleRadios" value="Cod" checked>
                            <label class="form-check-label" for="exampleRadios2">
                                Cash on delivery
                            </label>
                        </div>
                        <div class="form-check pb-1">
                            <input class="form-check-input" type="radio" name="exampleRadios" value="Upi">
                            <label class="form-check-label" for="exampleRadios1">
                                UPI Gateway
                            </label>
                        </div>
                        <div class="form-check disabled">
                            <input class="form-check-input" type="radio" name="exampleRadios" value="Card">
                            <label class="form-check-label" for="exampleRadios3">
                                Debit/Credit card
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card" style="width: 100%">
                    <div class="card-body">
                        <h5 class="card-title pt-1 pb-2">Checkout</h5>
                        <h6 class="card-title">Subtotal - <b class="totalQty"><?php echo isset($subTotal) ? count($Cart->getCart()) : 0; ?></b> Items: <span class="text-success subTotal">
                                <?php echo isset($subTotal) ? $Cart->getSum($subTotal) : 0; ?></span><span class="text-success"> Qr</span>
                        </h6>
                        <a onclick="<?php if (isset($subTotal)) $_SESSION['totalCart'] = $subTotal; ?> return confirm_order(<?php echo count($Cart->getCart()) ?>, <?php echo isset($_SESSION['user_id']) ?>)" href="/applabshop/user/cart/index.php?checkout=true" class="btn btn-sm btn-primary mt-2 checkoutBtn">
                            Proceed to Buy
                        </a>
                    </div>
                </div>

                <script>
                    function confirm_order(count, isLoggedIn) {
                        if (count === 0) {
                            alert('Your cart is empty.');
                            return false;
                        } else if (!confirm("Would you like to proceed you order?")) {
                            return false;
                        } else if (isLoggedIn !== 1) {
                            window.location.href = '/applabshop/auth/login.php?checkout=true';
                            return false;
                        } else if (isLoggedIn === 1) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                </script>

            </div>
        </div>
    </div>

</section>

<?php include('../views/footer.php') ?>