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

<?php include('templates/header.php') ?>

<section class="container">
    <div class="m-5">
        <div class="page-header">
            <h3>Cart</h3>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Image</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-danger">Danger</button>
                        <button type="button" class="btn btn-sm btn-danger">Danger</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</section>

<?php include('templates/footer.php') ?>

</html>