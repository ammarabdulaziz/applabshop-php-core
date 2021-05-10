<?php

if (isset($_POST['submit'])) {
    echo htmlspecialchars($_POST['title']);
    echo htmlspecialchars($_POST['brand']);
    echo htmlspecialchars($_POST['specs']);
}

?>

<!DOCTYPE html>

<?php include('templates/header.php') ?>

<section class="container">
    <div class="page-header mt-5">
        <h3 id="forms">Add a Product</h3>
    </div>
    <form action="add.php" method="POST">
        <div class="form-group row mt-4">
            <label class="col-sm-2 col-form-label">Title</label>
            <div class="col-md-6">
                <input type="text" name="title" class="form-control" placeholder="Title">
            </div>
        </div>
        <div class="form-group row mt-4">
            <label class="col-sm-2 col-form-label">Brand</label>
            <div class="col-md-6">
                <input type="text" name="brand" class="form-control" placeholder="Brand">
            </div>
        </div>
        <div class="form-group row mt-4">
            <label class="col-sm-2 col-form-label">Specifications</label>
            <div class="col-md-6">
                <input type="text" name="specs" class="form-control" placeholder="Specifications">
                <small class="text-muted">Coma seperated</small>
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