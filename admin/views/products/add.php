<!DOCTYPE html>

<style>
    .hide {
        display: none;
    }

    .show {
        display: block;
    }
</style>

<?php include('../views/sidebar.php'); ?>

<section class="container" style="margin-top: 6em !important;">
    <div class="page-header mt-5">
        <h3 id="forms">Add a Product</h3>
    </div>
    <form action="/applabshop/admin/products/store.php" method="POST" enctype="multipart/form-data">
        <div class="form-group row mt-4">
            <label class="col-sm-2 col-form-label">Name</label>
            <div class="col-md-6">
                <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo isset($name) ? $name : '' ?>">
                <small class="text-danger"><?php echo $errors['name'] ?? '' ?></small>
            </div>
        </div>
        <div class="form-group row mt-4">
            <label class="col-sm-2 col-form-label">Brand</label>
            <div class="col-md-6">
                <input type="text" name="brand" class="form-control" placeholder="Brand" value="<?php echo isset($brand) ? $brand : '' ?>">
                <small class="text-danger"><?php echo $errors['brand'] ?? '' ?></small>
            </div>
        </div>
        <div class="form-group row mt-4">
            <label class="col-sm-2 col-form-label">Price</label>
            <div class="col-md-6">
                <input type="text" name="price" class="form-control" placeholder="Price" value="<?php echo isset($price) ? $price : '' ?>">
                <small class="text-danger"><?php echo $errors['price'] ?? '' ?></small>
            </div>
        </div>
        <div class="form-group row mt-4">
            <label class="col-sm-2 col-form-label">Specifications</label>
            <div class="col-md-6">
                <input type="text" name="specs" class="form-control" placeholder="Specifications" value="<?php echo isset($specs) ? $specs : '' ?>">
                <small class="text-muted">Coma seperated</small><br>
                <small class="text-danger"><?php echo $errors['specs'] ?? '' ?></small>
            </div>
        </div>
        <div class="form-group row mt-4">
            <label class="col-sm-2 col-form-label">Image</label>
            <div class="col-md-6">
                <input type="file" id="upload" onchange="readURL(this)" name="image" class="form-control-file"><br>
                <small class="text-danger"><?php echo $errors['image'] ?? '' ?></small>
                <img id="img" class="hide" alt="1.png" height="100px" width="auto" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px, rgba(0, 0, 0, 0.05) 0px 4px 6px -2px;">
            </div>
            <script>
                function readURL(input) {
                    var url = input.value;
                    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                    if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('#img').addClass('show').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);
                    } else {
                        $('#img').attr('src', '/assets/no_preview.png');
                    }
                }
            </script>
        </div>
        <div class="form-group row mt-3">
            <div class="offset-sm-2 col-sm-10">
                <button type="submit" name="submit" class="btn btn-primary px-4">Add</button>
            </div>
        </div>
    </form>
</section>

<?php include('../views/footer.php') ?>

</html>