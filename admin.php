<?php

if (session_status() == PHP_SESSION_NONE) session_start();
require('functions.php');


?>

<!DOCTYPE html>

<?php include('templates/sidebar.php') ?>
<?php include('list-products.php') ?>
<?php include('templates/footer.php') ?>

</html>