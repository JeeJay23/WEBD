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

    <?= 'user id: ' . $_SESSION['uid'] ?>
    <?= 'username: ' . $_SESSION['uname'] ?>

    <div class="flex-container">
        <div class="container">
            <h1 class="text-danger">SALE SALE SALE</h1>

            <h1>Categories</h1>
            <?php
            $categories = getCategories($mysqli);

            // loop through $categories to display them
            echo '<ul>';
            foreach ($categories as $category) {
                echo '<li><a href="index.php?category=' . $category['ID'] . '"> <h3>' . $category['strName'] . '</h3></a>';
                echo '<ul>';
                foreach ($category['subcategories'] as $subcategory) {
                    echo '<li><a href="index.php?category=' . $subcategory['ID'] . '"><h4>' . $subcategory['strName'] . '</h4></a></li>';
                }
                echo '</li></ul>';
            }
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

    <!-- reload page on click for easy debugging -->
    <script>
        window.addEventListener('focus', () => {
            document.location = document.location
        })
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</body>

</html>