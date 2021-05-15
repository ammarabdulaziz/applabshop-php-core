<head>
    <html lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AppLab Shop</title>

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous"> -->

    <link rel="stylesheet" href="templates/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="templates/bootstrap/bootstrap.min.css">

<body>

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
                            <a class="nav-link" href="cart.php">Cart <span class="badge rounded-pill bg-warning"><?php echo count($product->getData(table: 'cart')); ?></span></a>
                        </li>
                        <li class="nav-item ps-4">
                            <a class="btn btn-secondary my-2 my-sm-0" href="#">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>