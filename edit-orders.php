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
        } elseif ($_POST['action'] === 'update') {
            updateOrder($mysqli, $_POST['ID'], $_POST['strStatus']);
        } elseif ($_POST['action'] === 'delete') {
            deleteOrder($mysqli, $_POST['id']);
        }
    }

    $orders = getOrders($mysqli);
    ?>

    <div class="flex-container">
        <div class="container">
            <h1>Orders</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Order date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($orders as $order) {
                    ?>
                        <tr>
                            <form action="edit-orders.php" method="post">
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="ID" value="<?= $order['ID'] ?>">
                                <td><?php echo $order['ID']; ?></td>
                                <td><?php echo $order['strOwnerName']; ?></td>
                                <td><?php echo $order['dtDate']; ?></td>
                                <td>
                                    <select name="strStatus" class="form-control" required>
                                        <option value="<?= $order['strStatus'] ?>" selected disabled><?= $order['strStatus'] ?></option>
                                        <option value="In progress">In progress</option>
                                        <option value="Sent">Sent</option>
                                    </select>
                                </td>
                                <td>
                                    <button class='btn btn-primary' type="submit">Update</button>
                            </form>
                            <form action="edit-orders.php" method="post">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= $order['ID'] ?>">
                                <button class='btn btn-danger' type="submit">Delete</button>
                            </form>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>