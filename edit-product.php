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

    $product = getProduct($mysqli, $_GET['id']);
    $categories = getCategoriesFlat($mysqli);
    ?>

    <div class="flex-container">
        <div class="container">
            <h1>Editing product <?= $product['ID'] ?></h1>
            <form action="edit-products.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="ID" value="<?= $product['ID'] ?>">
                <div class="mb-3">
                    <label for="strName" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="strName" name="strName" value="<?= $product['strName'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="idCategory" class="form-label">Category</label>
                    <select name="idCategory" class="form-control" required>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category['ID'] ?>" <?php
                                                                    if ($category['ID'] == $product['idCategory']) {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>
                                <?= $category['strName'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="blbFullImage" class="form-label">Product Image</label>
                    <input type="file" class="form-control" id="blbFullImage" name="blbFullImage" value="<?= $product['pthFullImage'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="strDescription" class="form-label">Product Description</label>
                    <textarea class="form-control" id="strDescription" name="strDescription"><?= $product['strDescription'] ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="fltPrice" class="form-label">Product Price</label>
                    <input type="number" step="0.01" class="form-control" id="fltPrice" name="fltPrice" value="<?= $product['fltPrice'] ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                <div id="priceToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <strong class="me-auto">Warning</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        Product price cannot be less than zero.
                    </div>
                </div>
            </div>
            <form action="edit-products.php">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" value="<?= $product['ID'] ?>">
                <input type="submit" value="Delete" class="btn btn-danger">
            </form>
        </div>


        <script>
            document.querySelector('form').addEventListener('submit', function(event) {
                var priceInput = document.getElementById('fltPrice');
                var priceValue = parseFloat(priceInput.value);

                if (priceValue < 0) {
                    priceInput.classList.add('is-invalid');
                    event.preventDefault();
                    priceInput.focus();

                    var toastEl = document.getElementById('priceToast');
                    var toast = new bootstrap.Toast(toastEl);
                    toast.show();
                }
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>