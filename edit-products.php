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
        if ($_POST['action'] === 'create') {
            createProduct(
                $mysqli,
                $_POST['strName'],
                $_POST['idCategory'],
                $_FILES['blbFullImage'],
                $_POST['strDescription'],
                $_POST['fltPrice']
            );
        } elseif ($_POST['action'] === 'update') {
            updateProduct(
                $mysqli,
                $_POST['ID'],
                $_POST['strName'],
                $_POST['idCategory'],
                $_FILES['blbFullImage'],
                $_POST['strDescription'],
                $_POST['fltPrice']
            );
        } elseif ($_POST['action'] === 'delete') {
            deleteProduct($mysqli, $_POST['id']);
        }

        $categories = getCategoriesFlat($mysqli);
    }
    ?>

    <div class="flex-container">
        <div class="container">
            <h1>Product list</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $products = getProducts($mysqli);
                    foreach ($products as $product) :
                    ?>
                        <tr>
                            <td><?= $product['ID'] ?></td>
                            <td><?= $product['strName'] ?></td>
                            <td><?= $product['strCategoryName'] ?></td>
                            <td><img src="<?= $product['pthFullImage'] ?>" width="100" height="100" alt="<?= $product['pthFullImage'] ?>" srcset=""></td>
                            <td><?= $product['strDescription'] ?></td>
                            <td><?= $product['fltPrice'] ?></td>
                            <td>
                                <a href="edit-product.php?id=<?= $product['ID'] ?>" class="btn btn-primary">Edit</a>
                                <form action="edit-products.php" method="post" style="display: inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?= $product['ID'] ?>">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h1>Add product</h1>
            <!-- Create product form -->
            <form action="edit-products.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action" value="create">
                <div class="mb-3">
                    <label for="strName" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="strName" name="strName" required>
                </div>
                <div class="mb-3">
                    <label for="idCategory" class="form-label">Category</label>
                    <select name="idCategory" class="form-control" required>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category['ID'] ?>"><?= $category['strName'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="blbFullImage" class="form-label">Product Image</label>
                    <input type="file" class="form-control" id="blbFullImage" name="blbFullImage" required>
                </div>
                <div class="mb-3">
                    <label for="strDescription" class="form-label">Product Description</label>
                    <textarea class="form-control" id="strDescription" name="strDescription" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="fltPrice" class="form-label">Product Price</label>
                    <input type="number" step="0.01" class="form-control" id="fltPrice" name="fltPrice" required>
                </div>
                <button type="submit" class="btn btn-primary">Create Product</button>
            </form>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>