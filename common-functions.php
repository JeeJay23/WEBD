<?php

function getCategories($mysqli)
{
    $sql = "SELECT * FROM category c";
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

function createCategory($mysqli, $strName, $idParentCategory = null)
{
    if ($idParentCategory == null) {
        $sql = "INSERT INTO category (strName) VALUES (?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('s', $strName);
    }
    else {
        $sql = "INSERT INTO category (strName, idParentCategory) VALUES (?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('si', $strName, $idParentCategory);
    }
    $stmt->execute();
}

function updateCategory($mysqli, $id, $strName, $idParentCategory = null)
{
    $sql = "UPDATE category SET strName = ?, idParentCategory = ? WHERE ID = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sii', $strName, $idParentCategory, $id);
    $stmt->execute();
}

function deleteCategory($mysqli, $id)
{
    $sql = "DELETE FROM category WHERE ID = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
}

function flattenCategories($categories)
{
}
