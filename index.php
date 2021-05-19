<?php

// $conn = mysqli_connect('localhost', 'root', '', 'applabshop');

// if (!$conn) echo 'Connection err: ' . mysqli_connect_error();

if (session_status() == PHP_SESSION_NONE) session_start();

// $products = $Product->getData();

// if ($_SERVER['REQUEST_METHOD'] == "POST") {
//     if (isset($_POST['cart_submit'])) {
//         $Cart->addToCart($_POST['user_id'], $_POST['item_id']);
//     }
// }

?>

<!DOCTYPE html>

<?php include('templates/header.php') ?>
<?php include('products.php') ?>
<?php include('templates/footer.php') ?>


</html>