<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEBD project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'database.php'; ?>
    <?php include 'navbar.php'; ?>

    <div class="container">
        <?php
            // Query to fetch data
            $sql = "SELECT t.ID, t.strName, fltPrice, strDescription, blbThumbnail, c.strName as categoryName FROM tblproduct t
            INNER JOIN category c ON t.idCategory = c.ID
            WHERE t.ID = " . $_GET['id'];
            // Execute the query
            $result = $mysqli->query($sql);
            // Check if there are any results
            if ($result->num_rows > 0) {
                // Output data for each row
                while ($row = $result->fetch_assoc()) {
                    $productID = $row['ID'];
                    // Convert the blob to a base64 encoded string
                    $image = base64_encode($row['blbThumbnail']);
                    echo '<div class="container">';
                    echo '<div class="row">';
                    echo '<div class="col-md-6">';
                    echo '<img src="data:image/jpeg;base64,' . $image . '" class="product-image" alt="bb 1" srcset="">';
                    echo '</div>';
                    echo '<div class="col-md-6">';
                    echo '<p class=.text-info">' . $row['categoryName'] . '</p>';
                    echo '<h1>' . $row['strName'] . '</h1>';
                    echo '<h1 ><em class="text-primary">Price: €' . $row['fltPrice'] . '</em></h1>';
                    echo '<p>' . $row['strDescription'] . '</p>';
                    echo '<a href="shopping-cart.php?id=' . $productID . '" class="btn btn-primary">Add to cart</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "No results";
            }
        ?>
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