<?php include('../views/sidebar.php') ?>

<div class="m-5" style="margin-top: 6em !important;">
    <div class="page-header d-flex justify-content-between">
        <h3>Products</h3>
        <a href="add.php" style="padding-top: 9px;" class="btn btn-success"><i class='bx bxs-cart-add'></i> Add Product</a>
    </div>

    <table class="table mt-3">

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
                    <td class="align-middle"><img id="image-<?php echo $product['item_id'] ?>" src="<?php echo $product['image'] ?>" style="height: 50px; width: auto"></td>
                    <td class="align-middle"><?php echo $product['price'] ?? 'Unkown' ?></td>
                    <td class="align-middle">
                        <a href='edit.php?id=<?php echo $product['item_id'] ?? 'Unkown' ?>' type="button" class="btn btn-sm btn-info"><i class='bx bxs-edit-alt pt-1 pb-1'></i></a>
                        <a onclick="return delete_confirm(<?php echo $product['item_id'] ?? null ?>)" type="button" class="btn btn-sm btn-danger text-light"><i class='bx bx-x pt-1 pb-1'></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <script>
        let image;

        function delete_confirm(id) {
            if (id && confirm("Are you sure you want to delete this product?")) {
                image = $(`#image-${id}`).attr('src');
                $.ajax({
                    url: '/applabshop/admin/products/delete.php',
                    type: 'post',
                    data: {
                        id,
                        image: image,
                        deleteProduct: true,
                    },
                    success: function(result) {
                        window.location.reload();
                    },
                });
                return true;
            } else {
                return false;
            }
        }
    </script>


</div>
<?php include('../views/footer.php') ?>