<?php

function getCategories($mysqli)
{
    $sql = "SELECT * FROM category";
    $result = $mysqli->query($sql);

    // Initialize an array to hold the categories
    $categories = array();

    // Loop through the categories
    while ($row = $result->fetch_assoc()) {
        // If the category has a parent, add it to the parent's subcategories
        if ($row['idParentCategory'] != null) {
            $categories[$row['idParentCategory']]['subcategories'][] = $row;
        }
        // If the category doesn't have a parent, add it to the top level
        else {
            $categories[$row['ID']] = $row;
            $categories[$row['ID']]['subcategories'] = array();
        }
    }

    return $categories;
}
