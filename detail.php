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
    ?>

    <div class="container">
        <?php
            $product = getProduct($mysqli, $_GET['id']);

        ?>

        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="<?= $product['pthFullImage'] ?>" class="product-image" alt="<?= $product['pthFullImage'] ?>">
                </div>
                <div class="col-md-6">
                    <h1><?= $product['strName'] ?></h1>
                    <p class="text-info"><?= $product['strCategoryName'] ?></p>
                    <p><?= $product['strDescription'] ?></p>
                    <p class="text-primary">€<?= $product['fltPrice'] ?></p>
                    <a href="shopping-cart.php?id=<?= $product['ID'] ?>" class="btn btn-primary">Add to cart</a>
                </div>
            </div>

            <h1>Related products</h1>
            <div class="row">
                <?php
                    // Query to fetch data
                    $sql = "SELECT * FROM tblproduct WHERE idCategory = " . $product['idCategory'] . " AND ID != " . $product['ID'];
                    // Execute the query
                    $result = $mysqli->query($sql);
                    // Check if there are any results
                    if ($result->num_rows > 0) {
                        // Output data for each row
                        while ($row = $result->fetch_assoc()) {
                            $productID = $row['ID'];
                            echo '<div class="col-3">';
                            echo '<img src="' . $row['pthFullImage'] . '" width="200" height="200" alt="bb 1" srcset="">';
                            echo '<p>' . $row['strName'] . '</p>';
                            echo '<p class="text-primary">€' . $row['fltPrice'] . '</p>';
                            echo '<a href="detail.php?id=' . $productID . '"class="btn btn-primary">View</a>';
                            echo '</div>';
                        }
                    } else {
                        echo "No results";
                    }
                ?>
            </div>
        </div>
    </div>

    <!-- reload page on click for easy debugging -->
    <script>
        window.addEventListener('focus', () => {
            document.location = document.location
        })
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</body>

</html>