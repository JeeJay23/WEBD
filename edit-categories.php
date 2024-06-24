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
    // Fetch all categories
    $categories = getCategoriesFlat($mysqli);

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($_POST['action'] === 'create') {
            createCategory($mysqli, $_POST['strName'], $_POST['idParentcategory']);
        } elseif ($_POST['action'] === 'update') {
            if (!isset($_POST['idParentCategory'])) {
                echo 'no parent category selected';
                updateCategory($mysqli, $_POST['ID'], $_POST['strName'], null);
            } else {
                echo 'parent category selected';
                updateCategory($mysqli, $_POST['ID'], $_POST['strName'], $_POST['idParentCategory']);
            }
        } elseif ($_POST['action'] === 'delete') {
            deleteCategory($mysqli, $_POST['ID']);
        }

        // Refresh categories after changes
        $categories = getCategoriesFlat($mysqli);
    }
    ?>

    <div class="flex-container">
        <div class="container">
            <form action="" method="post" class="mb-3">
                <input type="hidden" name="action" value="create">
                <div class="row">
                    <div class="col mb-3">
                        <input type="text" name="strName" class="form-control" placeholder="Category Name" required>
                    </div>
                    <div class="col mb-3">
                        <select name="idParentcategory" class="form-control">
                            <option value="">None</option>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category['ID'] ?>"><?= $category['strName'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary">Create Category</button>
            </form>

            <h2>Edit existing categories</h2>
            <!-- List of categories -->
            <?php foreach ($categories as $category) : ?>
                <div class="mb-3">
                    <form action="" method="post">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="ID" value="<?= $category['ID'] ?>">
                        <div class="row">
                            <div class="col mb-3">
                                <input type="text" name="strName" class="form-control" value="<?= $category['strName'] ?>" required>
                            </div>
                            <div class="col mb-3">
                                <select name="idParentCategory" class="form-control">
                                    <option value="">None</option>
                                    <?php foreach ($categories as $subcategory) : ?>
                                        <option 
                                            value="<?= $subcategory['ID'] ?>" 
                                            <?php 
                                                if ($category['ID'] == $subcategory['ID']) {
                                                    echo 'disabled';
                                                }
                                                if ($subcategory['ID'] == $category['idParentCategory']) {
                                                    echo 'selected';
                                                }
                                             ?> >
                                            <?= $subcategory['strName'] ?>
                                        </option>
                                    <?php  endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="col mb-3 btn btn-primary">Update</button>
                        </div>
                    </form>
                    <form action="" method="post">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="ID" value="<?= $category['ID'] ?>">
                        <button type="submit" class="btn btn-danger">Delete Category</button>
                    </form>
                </div>
            <?php endforeach; ?>
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