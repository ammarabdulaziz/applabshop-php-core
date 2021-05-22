<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require('functions.php');

$product = $Product->getProduct($_GET['id']);

$errors = array('name' => '', 'brand' => '', 'price' => '', 'specs' => '', 'image' => '');
$name = $brand = $price = $image = $specs = '';

$item_id = $product[0]['item_id'];
$name = $product[0]['name'];
$brand = $product[0]['brand'];
$price = $product[0]['price'];
$specs = $product[0]['specs'];
$image = $product[0]['image'];

if (isset($_POST['submit'])) {
    // Check name 
    if (empty($_POST['name'])) $errors['name'] = 'Name is empty <br>';

    // Check brand
    if (empty($_POST['brand'])) $errors['brand'] = 'Brand is empty <br>';

    // Check price
    if (empty($_POST['price'])) $errors['price'] = 'Price is empty <br>';

    // Check specs
    if (empty($_POST['specs'])) $errors['specs'] = 'Enter atleast one specification <br>';

    // Check image
    $path = $_POST['image'];
    if (!empty($_FILES['image']['tmp_name'])) {
        $file_name = time();
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_props_arr = explode('.', $_FILES['image']['name']);
        $file_ext = strtolower(end($file_props_arr));

        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extensions) === false) $errors['image'] = "Extension not allowed, please choose a JPEG or PNG file <br>";
        if ($file_size > 2097152) $errors['image'] = 'File size must be less than 2 MB  <br>';

        unlink($path);
        $path = "public/images/" . $file_name . '.' . $file_ext;
    }

    if (!array_filter($errors)) {
        $result = $Product->editProduct($_POST['item_id'], $_POST['name'], $_POST['brand'], $_POST['price'], $_POST['specs'], $path);
        if (isset($result)) {
            move_uploaded_file($file_tmp, $path);
            header('Location: admin.php');
        }
    }
}

?>

<!DOCTYPE html>


<?php include('templates/sidebar.php'); ?>

<section class="container" style="margin-top: 6em !important;">
    <div class="page-header mt-5">
        <h3 id="forms">Edit Product</h3>
    </div>
    <form action="products-edit.php?id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="item_id" class="form-control" placeholder="Name" value="<?php echo htmlspecialchars($item_id); ?>">
        <div class="form-group row mt-4">
            <label class="col-sm-2 col-form-label">Name</label>
            <div class="col-md-6">
                <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo htmlspecialchars($name); ?>">
                <small class="text-danger"><?php echo $errors['name'] ?></small>
            </div>
        </div>
        <div class="form-group row mt-4">
            <label class="col-sm-2 col-form-label">Brand</label>
            <div class="col-md-6">
                <input type="text" name="brand" class="form-control" placeholder="Brand" value="<?php echo htmlspecialchars($brand); ?>">
                <small class="text-danger"><?php echo $errors['brand'] ?></small>
            </div>
        </div>
        <div class="form-group row mt-4">
            <label class="col-sm-2 col-form-label">Price</label>
            <div class="col-md-6">
                <input type="text" name="price" class="form-control" placeholder="Price" value="<?php echo htmlspecialchars($price); ?>">
                <small class="text-danger"><?php echo $errors['price'] ?></small>
            </div>
        </div>
        <div class="form-group row mt-4">
            <label class="col-sm-2 col-form-label">Specifications</label>
            <div class="col-md-6">
                <input type="text" name="specs" class="form-control" placeholder="Specifications" value="<?php echo htmlspecialchars($specs); ?>">
                <small class="text-muted">Coma seperated</small><br>
                <small class="text-danger"><?php echo $errors['specs'] ?></small>
            </div>
        </div>
        <div class="form-group row mt-4">
            <label class="col-sm-2 col-form-label">Image</label>
            <div class="col-md-6">
                <input type="hidden" name="image" value="<?php echo $image ?>">
                <input type="file" id="upload" onchange="readURL(this)" name="image" class="form-control-file"><br>
                <small class="text-danger"><?php echo $errors['image'] ?></small>
                <img id="img" src="<?php echo $image; ?>" class="pt-3 hide" alt="1.png" height="100px" width="auto" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px, rgba(0, 0, 0, 0.05) 0px 4px 6px -2px;">
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


<?php include('templates/footer.php') ?>

</html>