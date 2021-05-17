<?php
session_start();
require('functions.php');

if (isset($_SESSION['username'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) $error = $User->loginUser($_POST['username'], md5($_POST['password']));

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://use.fontawesome.com/faba194bed.js"></script>

    <link rel="stylesheet" type="text/css" href="templates/style.css">

    <title>Applab Shop | Login</title>
</head>

<body>
    <div class="container">
        <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
        <div class="alert alert__error spacer <?php if (!isset($error)) echo 'closed' ?>" role="alert"><i class="fa fa-minus-circle alert__icon"></i>
            <p class="alert__text">Invalid Username or Password</p><button type="button" class="alert__close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times-circle alert__close"></i></span></button>
        </div>
        <form action="login.php" method="POST" class="login-email">
            <div class="input-group">
                <input type="text" placeholder="Username" name="username" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" required>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Login</button>
            </div>
            <p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p>
            <p class="login-register-text"><a href="index.php">Continue without login</a></p>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <script>
        $('.alert__close').click(function() {
            $(this).parent().addClass('closed');
        });
    </script>
</body>

</html>