<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require('functions.php');

$errors = array('name' => '', 'brand' => '', 'price' => '', 'specs' => '', 'image' => '');
$name = $brand = $price = $image = $specs = '';

if (isset($_POST['submit'])) {
    // Check name 
    if (empty($_POST['name'])) {
        $errors['name'] = 'Name is empty <br>';
    } else {
        $name = $_POST['name'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
            $errors['name'] = 'Name should be letters and spaced only <br>';
        }
    }

    // Check brand
    if (empty($_POST['brand'])) {
        $errors['brand'] = 'Brand is empty <br>';
    } else {
        $brand = $_POST['brand'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $brand)) {
            $errors['brand'] = 'Brand should be letters and spaced only <br>';
        }
    }

    // Check price
    if (empty($_POST['price'])) {
        $errors['price'] = 'Price is empty <br>';
    } else {
        $price = $_POST['price'];
        if (!preg_match('/^[1-9\s]+$/', $price)) {
            $errors['price'] = 'Price should be numbers only <br>';
        }
    }

    // Check specs
    if (empty($_POST['specs'])) {
        $errors['specs'] = 'Enter atleast one specification <br>';
    } else {
        $specs = $_POST['specs'];
        if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $specs)) {
            $errors['specs'] = 'Specifications should be coma seperated <br>';
        }
    }

    // Check image
    if (empty($_FILES['image']['tmp_name'])) {
        $errors['image'] = 'Image is empty <br>';
    } else {
        $file_name = time();
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));

        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extensions) === false) {
            $errors['image'] = "Extension not allowed, please choose a JPEG or PNG file <br>";
        }

        if ($file_size > 2097152) {
            $errors['image'] = 'File size must be less than 2 MB  <br>';
        }
    }

    if (!array_filter($errors)) {
        $path = "public/images/" . $file_name . '.' . $file_ext;
        $result = $Product->addProduct($_POST['name'], $_POST['brand'], $_POST['price'], $_POST['specs'], $path);
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
        <h3 id="forms">Add a Product</h3>
    </div>
    <form action="products-add.php" method="POST" enctype="multipart/form-data">
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
                <input type="file" name="image" class="form-control-file"><br>
                <small class="text-danger"><?php echo $errors['image'] ?></small>
            </div>
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