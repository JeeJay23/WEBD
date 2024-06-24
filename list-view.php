<div class="row mb-3">
    <?php
    // Query to fetch data
    if (isset($category) && !is_array($category)) {
        $products = getProductsByCategory($mysqli, $category);
    } else {
        $products = getProducts($mysqli);
    }
    ?>

    <?php foreach ($products as $product) : ?>
        <div class="col-3">
            <img src="<?= $product['pthFullImage'] ?>" width="200" height="200" alt="bb 1" srcset="">
            <p><?= $product['strName'] ?></p>
            <p class="text-primary">€<?= $product['fltPrice'] ?></p>
            <a href="detail.php?id=<?= $product['ID'] ?>" class="btn btn-primary">View</a>
            <form action="shopping-cart.php" method="post">
                <input type="hidden" name="ID" value="<?= $product['ID'] ?>">
                <input type="hidden" name="action" value="add">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="btn btn-success">Add to cart</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>