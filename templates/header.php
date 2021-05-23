<?php
require('functions.php');
// var_export($_SESSION['totalCart']);
?>

<head>
    <html lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AppLab Shop</title>

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="public/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="public/bootstrap/bootstrap.min.css">

<body>
    <div class="loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container container-fluid">
            <a class="navbar-brand" href="index.php">Applab Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto"></ul>
                <div class="d-flex">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item ps-4">
                            <a class="nav-link active" href="index.php">Home
                                <span class="visually-hidden">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item ps-4">
                            <a class="nav-link" href="<?php echo isset($_SESSION['user_id']) ? 'orders.php' : 'login.php?orders=true' ?>">Orders</a>
                        </li>
                        <li class="nav-item ps-4">
                            <a class="nav-link" href="cart.php">Cart <span class="badge rounded-pill bg-warning qty-badge"><?php echo count($Cart->getCart()); ?></span></a>
                        </li>
                        <li class="nav-item ps-4">
                            <?php
                            if (isset($_SESSION['user_id'])) echo '<a class="btn btn-secondary my-2 my-sm-0" href="logout.php">Logout</a>';
                            else echo '<a class="btn btn-secondary my-2 my-sm-0" href="login.php">Login</a>';
                            ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>