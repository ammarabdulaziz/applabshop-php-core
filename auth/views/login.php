<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://use.fontawesome.com/faba194bed.js"></script>

    <link rel="stylesheet" type="text/css" href="../public/stylesheets/style.css">
    <link rel="stylesheet" type="text/css" href="../public/stylesheets/sidebar.css">

    <title>Applab Shop | Login</title>
</head>

<body>
    <!-- <div class="loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div> -->
    <div class="container">
        <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
        <div class="alert <?php echo isset($error) ? 'alert__error' : 'alert__success'; ?> spacer closed
        <?php if (isset($error) || isset($checkout) || isset($orders)) echo 'show' ?>" role="alert">
            <i class="fa fa-minus-circle alert__icon"></i>
            <p class="alert__text"><?php echo isset($error) ? 'Invalid Username or Password' : 'Please login to continue'; ?></p>
            <button type="button" class="alert__close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">
                    <i class="fa fa-times-circle alert__close"></i></span>
            </button>
        </div>
        <form action="/applabshop/auth/login.php<?php echo isset($checkout) ? '?checkout=true'  : (isset($orders) ? '?orders=true' : '') ?>" method="POST" class="login-email">
            <div class="input-group">
                <input type="text" placeholder="Username" name="username" value="<?php echo $_POST['username'] ?? '' ?>">
                <small style="color: red; margin: 1.5em;"><?php echo $errors['username'] ?? '' ?></small>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password'] ?? '' ?>">
                <small style="color: red; margin: 1.5em;"><?php echo $errors['password'] ?? '' ?></small>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Login</button>
            </div>
            <p class="login-register-text">Don't have an account?
                <a href="/applabshop/auth/register.php<?php echo isset($checkout) ? '?checkout=true'  : (isset($orders) ? '?orders=true' : '') ?>">
                    Register Here
                </a>.
            </p>
            <p class="login-register-text"><a href="/applabshop/user/products/index.php">Continue without login</a></p>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <script>
        $('.alert__close').click(function() {
            $(this).parent().addClass('closed').removeClass('show');
        });
        $(window).on('load', function() {
            $('.loader-wrapper').fadeOut();
        });
    </script>
</body>

</html>