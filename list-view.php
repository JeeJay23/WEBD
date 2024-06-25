<?php
// Query to fetch data
if (isset($category) && !is_array($category)) {
    $products = getProductsByCategory($mysqli, $category);
} else {
    $onSale = isset($onSale) && $onSale;
    $products = getProducts($mysqli, $onSale);
}

?>

<div class="row mb-3">
    <?php foreach ($products as $product) : ?>
        <div class="col-3">
            <img src="<?= $product['pthFullImage'] ?>" width="200" height="200" alt="bb 1" srcset="">
            <p><?= $product['strName'] ?></p>
            <?php
            $price = $product['fltPrice'];
            if ($product['fltDiscountRate'] > 0) {
                $price *= (1 - $product['fltDiscountRate'] / 100);
            }
            ?>
            <h4 class="text-primary">
                €<?= number_format($price, 2) ?>
                <?php
                if ($product['fltDiscountRate'] > 0) {
                    echo '<span class="badge bg-success">' . number_format($product['fltDiscountRate'], 0) . '% off</span>';
                }
                ?>
            </h4>
            <div class="row">
                <div class="col">
                    <a href="detail.php?id=<?= $product['ID'] ?>" class="btn btn-primary">View</a>
                </div>
                <div class="col">
                    <form action="shopping-cart.php" method="post">
                        <input type="hidden" name="ID" value="<?= $product['ID'] ?>">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn btn-success">Add to cart</button>
                    </form>

                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>