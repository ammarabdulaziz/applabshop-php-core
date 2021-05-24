<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="../public/stylesheets/style.css">


    <title>Applab Shop | Register</title>
</head>

<body>
    <div class="container">
        <form action="/applabshop/auth/register.php<?php if (isset($checkout)) echo '?checkout=true' ?>" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
            <div class="input-group">
                <input type="text" placeholder="Name" name="name" value="<?php echo $_POST['name'] ?? '' ?>">
                <small style="color: red; margin: 1.5em;"><?php echo $errors['name'] ?? '' ?></small>
            </div>
            <div class="input-group">
                <input type="text" placeholder="Username" name="username" value="<?php echo $_POST['username'] ?? '' ?>">
                <small style="color: red; margin: 1.5em;"><?php echo $errors['username'] ?? '' ?></small>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password'] ?? '' ?>">
                <small style="color: red; margin: 1.5em;"><?php echo $errors['password'] ?? '' ?></small>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Register</button>
            </div>
            <p class="login-register-text">Have an account? <a href="/applabshop/auth/login.php<?php if (isset($checkout)) echo '?checkout=true' ?>">Login Here</a>.</p>
        </form>
    </div>
</body>

</html>