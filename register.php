<?php

session_start();
require('functions.php');

if (isset($_SESSION['username'])) {
    header("Location: index.php");
}

$errors = array('name' => '', 'username' => '', 'password' => '');

if (isset($_POST['submit'])) {

    if (empty($_POST['name'])) $errors['name'] = 'Name is empty';
    if (empty($_POST['username'])) $errors['username'] = 'Username is empty';
    if (empty($_POST['password'])) $errors['password'] = 'Password is empty';

    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    if (!array_filter($errors)) $errors['username'] = $User->createUser($name, $username, $password, $errors);
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="templates/style.css">


    <title>Applab Shop | Register</title>
</head>

<body>
    <div class="container">
        <form action="register.php" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
            <div class="input-group">
                <input type="text" placeholder="Name" name="name" value="<?php echo $_POST['name'] ?? '' ?>" required>
                <small style="color: red; margin: 1.5em;"><?php echo $errors['name'] ?></small>
            </div>
            <div class="input-group">
                <input type="text" placeholder="Username" name="username" value="<?php echo $_POST['username'] ?? '' ?>" required>
                <small style="color: red; margin: 1.5em;"><?php echo $errors['username'] ?></small>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password'] ?? '' ?>" required>
                <small style="color: red; margin: 1.5em;"><?php echo $errors['password'] ?></small>
            </div>
            <!-- <div class="input-group">
                <input type="password" placeholder="Confirm Password" name="cpassword" required>
            </div> -->
            <div class="input-group">
                <button name="submit" class="btn">Register</button>
            </div>
            <p class="login-register-text">Have an account? <a href="login.php">Login Here</a>.</p>
        </form>
    </div>
</body>

</html>