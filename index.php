<!DOCTYPE html>
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

    <div class="flex-container">
        <div class="container">
            <h1 class="text-danger">SALE SALE SALE</h1>
            <?php
            $onSale = true;
            include 'list-view.php';
            unset($onSale);
            ?>

            <h1>Categories</h1>
            <?php
            $categories = getCategories($mysqli);

            // loop through $categories to display them
            echo '<ul>';
            echo '<div class="row">';
            foreach ($categories as $category) {
                echo '<div class="col-md-4">';
                echo '<li><a href="index.php?category=' . $category['ID'] . '"> <h3>' . $category['strName'] . '</h3></a>';
                echo '<ul>';
                foreach ($category['subcategories'] as $subcategory) {
                    echo '<li><a href="index.php?category=' . $subcategory['ID'] . '"><h4>' . $subcategory['strName'] . '</h4></a></li>';
                }
                echo '</li></ul>';
                echo '</div>';
            }
            echo '</div>';
            echo '</ul>';
            ?>

            <h1>All products</h1>
            <?php
            if (isset($_GET['category'])) {
                // pass category, i dont know a better way to do this
                // now i do, just make a function. TODO implement this
                $category = $_GET['category'];
            }
            include 'list-view.php';
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
