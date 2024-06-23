<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
    <a href="/WEBD" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
        <img class="bi me-2" width="40" height="32" src="img/_8c57455a-bd11-4b52-af7d-1652585a6dbd.jpeg" alt="logo">
        <span class="fs-4">Browse 4 Beyblades</span>
    </a>

    <?php 
        session_start();
        $categories = getCategories($mysqli);
    ?>

    <ul class="nav nav-pills">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Categories
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php foreach ($categories as $category): ?>
                    <li><a class="dropdown-item" href="#"><?= $category['strName'] ?></a></li>
                <?php endforeach; ?>
            </ul>
        </li>
        <li class="nav-item"><a href="#" class="nav-link">Overview</a></li>
        <li class="nav-item"><a href="shopping-cart.php" class="nav-link">Shopping Cart</a></li>
        <?php if (isset($_SESSION['uid'])): ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?= $_SESSION['uname'] ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="#">Account Settings</a></li>
                    <?php if ($_SESSION['admin']): ?>
                        <li><a class="text-warning dropdown-item" href="edit-categories.php">edit categories</a></li>
                        <li><a class="text-warning dropdown-item" href="edit-products.php">edit products</a></li>
                    <?php endif; ?>
                    <li><a class="text-danger dropdown-item" href="#">Logout</a></li>
                </ul>
            </li>
        <?php else: ?>
            <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
        <?php endif; ?>
    </ul>
</header>