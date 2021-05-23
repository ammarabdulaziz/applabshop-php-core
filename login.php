<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require('functions.php');

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

$errors = array('name' => '', 'username' => '', 'password' => '');
$checkout = isset($_GET['checkout']) && $_GET['checkout'] == 'true' ? true : null;

if (isset($_POST['submit'])) {
    if (empty($_POST['username'])) $errors['username'] = 'Username is empty';
    if (empty($_POST['password'])) $errors['password'] = 'Password is empty';

    if (!array_filter($errors)) $error = $User->loginUser($_POST['username'], md5($_POST['password']), $checkout);
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://use.fontawesome.com/faba194bed.js"></script>

    <link rel="stylesheet" type="text/css" href="public/stylesheets/style.css">

    <title>Applab Shop | Login</title>
</head>

<body>
    <div class="container">
        <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
        <div class="alert <?php echo isset($error) ? 'alert__error' : 'alert__success'; ?> spacer closed
        <?php if (isset($error) || isset($checkout)) echo 'show' ?>" role="alert">
            <i class="fa fa-minus-circle alert__icon"></i>
            <p class="alert__text"><?php echo isset($error) ? 'Invalid Username or Password' : 'Please login to continue'; ?></p>
            <button type="button" class="alert__close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">
                    <i class="fa fa-times-circle alert__close"></i></span>
            </button>
        </div>
        <form action="login.php<?php if (isset($checkout)) echo '?checkout=true' ?>" method="POST" class="login-email">
            <div class="input-group">
                <input type="text" placeholder="Username" name="username" value="<?php echo $_POST['username'] ?? '' ?>">
                <small style="color: red; margin: 1.5em;"><?php echo $errors['username'] ?></small>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password'] ?? '' ?>">
                <small style="color: red; margin: 1.5em;"><?php echo $errors['password'] ?></small>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Login</button>
            </div>
            <p class="login-register-text">Don't have an account? <a href="register.php<?php if (isset($checkout)) echo '?checkout=true' ?>">Register Here</a>.</p>
            <p class="login-register-text"><a href="index.php">Continue without login</a></p>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <script>
        $('.alert__close').click(function() {
            $(this).parent().addClass('closed').removeClass('show');
        });
    </script>
</body>

</html>