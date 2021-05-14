<?php

$errors = array('title' => '', 'brand' => '', 'specs' => '');
$title = $brand = $specs = '';

if (isset($_POST['submit'])) {
    // Check title 
    if (empty($_POST['title'])) {
        $errors['title'] = 'Title is empty <br>';
    } else {
        $title = $_POST['title'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
            $errors['title'] = 'Title should be letters and spaced only <br>';
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

    // Check specs
    if (empty($_POST['specs'])) {
        $errors['specs'] = 'Enter atleast one specification <br>';
    } else {
        $specs = $_POST['specs'];
        if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $specs)) {
            $errors['specs'] = 'Specifications should be coma seperated <br>';
        }
    }

    if (array_filter($errors)) {
        echo 'Errors in form';
    } else {
        header('Location: index.php');
    }
}

?>

<!DOCTYPE html>

<?php include('templates/sidebar.php') ?>

<section class="container">
    <div class="page-header mt-5">
        <h3 id="forms">Add a Product</h3>
    </div>
    <form action="add.php" method="POST">
        <div class="form-group row mt-4">
            <label class="col-sm-2 col-form-label">Title</label>
            <div class="col-md-6">
                <input type="text" name="title" class="form-control" placeholder="Title" value="<?php echo htmlspecialchars($title); ?>">
                <small class="text-danger"><?php echo $errors['title'] ?></small></small>
            </div>
        </div>
        <div class="form-group row mt-4">
            <label class="col-sm-2 col-form-label">Brand</label>
            <div class="col-md-6">
                <input type="text" name="brand" class="form-control" placeholder="Brand" value="<?php echo htmlspecialchars($brand); ?>">
                <small class="text-danger"><?php echo $errors['brand'] ?></small></small>
            </div>
        </div>
        <div class="form-group row mt-4">
            <label class="col-sm-2 col-form-label">Specifications</label>
            <div class="col-md-6">
                <input type="text" name="specs" class="form-control" placeholder="Specifications" value="<?php echo htmlspecialchars($specs); ?>">
                <small class="text-muted">Coma seperated</small><br>
                <small class="text-danger"><?php echo $errors['specs'] ?></small></small>
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