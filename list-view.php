<div class="row mb-3">
    <?php
    // Query to fetch data
    if (isset($category) && !is_array($category)) {
        $sql = "SELECT * FROM tblproduct WHERE idCategory = " . $category;
    } else {
        $sql = "SELECT * FROM tblproduct";
    }
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        // Output data for each row
        while ($row = $result->fetch_assoc()) {
            $productID = $row['ID'];
            // Convert the blob to a base64 encoded string
            $image = base64_encode($row['blbThumbnail']);
            echo '<div class="col-3">';
            echo '<img src="data:image/jpeg;base64,' . $image . '" width="200" height="200" alt="bb 1" srcset="">';
            echo '<p>' . $row['strName'] . '</p>';
            echo '<p class="text-primary">€' . $row['fltPrice'] . '</p>';
            echo '<a href="detail.php?id=' . $productID . '"class="btn btn-primary">View</a>';
            echo '</div>';
        }
    } else {
        echo "No results";
    }
    ?>
</div>