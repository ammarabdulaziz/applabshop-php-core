<?php

if (session_status() == PHP_SESSION_NONE) session_start();

$products = $Product->getData();

?>

<!DOCTYPE html>


<div class="m-5" style="margin-top: 6em !important;">
    <div class="page-header d-flex justify-content-between">
        <h3>Products</h3>
        <a href="products-add.php" style="padding-top: 9px;" class="btn btn-success"><i class='bx bxs-cart-add'></i> Add Product</a>
    </div>

    <!-- <?php print("<pre>" . print_r($products, true) . "</pre>"); ?> -->
    <table class="table">

        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Brand</th>
                <th scope="col">Image</th>
                <th scope="col">Price</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product) { ?>
                <tr>
                    <th class="align-middle" scope="row"><?php echo $product['name'] ?? 'Unkown' ?></th>
                    <td class="align-middle"><?php echo $product['brand'] ?? 'Unkown' ?></td>
                    <td class="align-middle"><img class="card-img-top" src="<?php echo $product['image'] ?>" style="height: 50px; width: auto" alt="cart1"></td>
                    <td class="align-middle"><?php echo $product['price'] ?? 'Unkown' ?></td>
                    <td class="align-middle">
                        <a href='products-edit.php?id=<?php echo $product['item_id'] ?? 'Unkown' ?>' type="button" class="btn btn-sm btn-info"><i class='bx bxs-edit-alt'></i></a>
                        <a href='delete-product.php?id=<?php echo $product['item_id'] ?? 'Unkown' ?>' type="button" class="btn btn-sm btn-danger"><i class='bx bx-x'></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>

</html>