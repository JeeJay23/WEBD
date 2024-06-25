<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEBD project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include 'database.php';
    include 'common-functions.php';
    include 'navbar.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($_POST['action'] === 'add') {
            // check if user is logged in
            if (!isset($_SESSION['uid'])) {
                echo '<div class="alert alert-danger" role="alert">You need to be logged in to add products to your cart</div>';
                die();
            }
            // add product to session
            $_SESSION['cart'][$_POST['ID']] += $_POST['quantity'];

        } elseif ($_POST['action'] === 'update') {
            echo 'update';
        } elseif ($_POST['action'] === 'delete') {
            $_SESSION['cart'][$_POST['ID']] -= 1;
        } elseif ($_POST['action'] === 'checkout') {
            placeOrder($mysqli, $_SESSION['uid'], $_SESSION['cart']);
            $_SESSION['cart'] = [];
            echo '<div class="alert alert-success" role="alert">';
        }
    }
    ?>

    <div class="flex-container">
        <div class="container">
            <h1>Shopping cart</h1>
            <!-- Table for cart -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Total</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($_SESSION['cart'] as $productId => $quantity) {
                        if ($quantity <= 0) {
                            unset($_SESSION['cart'][$productId]);
                            continue;
                        }
                        $product = getProduct($mysqli, $productId);
                        $total = $product['fltPrice'] * $quantity;
                        ?>
                        <tr>
                            <td><?php echo $product['strName']; ?></td>
                            <td><?php echo $quantity; ?></td>
                            <td><?php echo $product['fltPrice']; ?></td>
                            <td><?php echo $total; ?></td>
                            <td>
                                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <input type="hidden" name="ID" value="<?php echo $productId; ?>">
                                    <input type="hidden" name="action" value="update">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <input type="hidden" name="ID" value="<?php echo $productId; ?>">
                                    <input type="hidden" name="action" value="delete">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td colspan="3"></td>
                        <?php $totalPrice = 0;
                        foreach ($_SESSION['cart'] as $productId => $quantity) {
                            $product = getProduct($mysqli, $productId);
                            $totalPrice += $product['fltPrice'] * $quantity;
                        }
                        echo '<td>' . $totalPrice . '</td>';
                        ?>

                        <td>
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <input type="hidden" name="action" value="checkout">
                                <button type="submit" class="btn btn-success">Checkout</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    

    <!-- reload page on click for easy debugging -->
    <script>
        window.addEventListener('focus', () => {
            document.location = document.location
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>