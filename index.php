<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEBD project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .flex-container {
            display: flex;
            height: 100vh; /* Full height */
        }
        .content {
            flex: 1; /* Take up the remaining space */
        }
    </style>
</head>

<body>
    <?php include 'database.php'; ?>
    <?php include 'navbar.php'; ?>

    <div class="flex-container">
        <?php include 'sidebar.php'; ?>
        <div class="container">
            <div class="row mb-3">
                <?php
                    // Query to fetch data
                    $sql = "SELECT * FROM tblproduct";
                    $result = $mysqli->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data for each row
                        while ($row = $result->fetch_assoc()) {
                            // Convert the blob to a base64 encoded string
                            $image = base64_encode($row['blbThumbnail']);
                            echo '<div class="col-3">';
                            echo '<img src="data:image/jpeg;base64,' . $image . '" width="200" height="200" alt="bb 1" srcset="">';
                            echo '<p>' . $row['strName'] . '</p>';
                            echo '<p>€' . $row['fltPrice'] . '</p>';
                            echo '<a href="detail.php" class="btn btn-primary">View</a>';
                            echo '</div>';
                        }
                    } else {
                        echo "No results";
                    }
                ?>
            </div>
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