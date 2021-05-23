<?php
if (session_status() == PHP_SESSION_NONE) session_start();
?>

<!DOCTYPE html>

<?php include('templates/sidebar.php') ?>
<?php include('products-list.php') ?>
<?php include('templates/footer.php') ?>

</html>