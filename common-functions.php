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

function getCategoriesFlat($mysqli)
{
    $sql = "SELECT c.ID, c.strName, c.idParentCategory, p.ID as idParent, p.strName as strParentName FROM category c
    left join category p on c.idParentCategory = p.ID";
    $result = $mysqli->query($sql);

    // Initialize an array to hold the categories
    $categories = array();

    // Loop through the categories
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
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

function getProducts($mysqli)
{
    $sql = "SELECT p.ID, p.strName, p.idCategory, c.strName as strCategoryName, p.pthFullImage, p.strDescription, p.fltPrice FROM tblProduct p
    left join category c on p.idCategory = c.ID";

    $result = $mysqli->query($sql);

    // Initialize an array to hold the products
    $products = array();

    // Loop through the products
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    return $products;
}

function getProduct($mysqli, $id)
{
    $sql = "SELECT p.ID, p.strName, p.idCategory, c.strName as strCategoryName, p.strDescription, p.fltPrice, p.pthFullImage FROM tblProduct p 
    left join category c on p.idCategory = c.ID
    WHERE p.ID = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_assoc();
}

function getProductsByCategory($mysqli, $idCategory)
{
    $sql = "SELECT * FROM tblProduct WHERE idCategory = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $idCategory);
    $stmt->execute();
    $result = $stmt->get_result();

    // Initialize an array to hold the products
    $products = array();

    // Loop through the products
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    return $products;
}

function updateProduct($mysqli, $id, $strName, $idCategory, $blbFullImage, $strDescription, $fltPrice)
{
    // Handle the file upload
    $target_dir = "img/";
    $target_file = $target_dir . basename($blbFullImage["name"]);
    move_uploaded_file($blbFullImage["tmp_name"], $target_file);

    $blbUploadImage = fopen($target_file, 'rb');

    $sql = "UPDATE tblProduct SET strName = ?, idCategory = ?, pthFullImage = ?, strDescription = ?, fltPrice = ? WHERE ID = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sisssi', $strName, $idCategory, $target_file, $strDescription, $fltPrice, $id);
    $stmt->execute();
}

function deleteProduct($mysqli, $id)
{
    $sql = "DELETE FROM tblProduct WHERE ID = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
}

function createProduct($mysqli, $strName, $idCategory, $blbFullImage, $strDescription, $fltPrice)
{
    // Handle the file upload
    $target_dir = "img/";
    $target_file = $target_dir . basename($blbFullImage["name"]);
    move_uploaded_file($blbFullImage["tmp_name"], $target_file);

    $sql = "INSERT INTO tblProduct (strName, idCategory, pthFullImage, strDescription, fltPrice) VALUES (?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sisss', $strName, $idCategory, $target_file, $strDescription, $fltPrice);
    $stmt->execute();
}

function placeOrder($mysqli, $uid, $cart)
{
    $sql = "INSERT INTO tblOrder (idOwner, dtDate, strStatus) VALUES (?, CURDATE(), 'In progress')";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $uid);
    $stmt->execute();

    $orderID = $mysqli->insert_id;

    foreach ($cart as $productID => $quantity) {
        $sql = "INSERT INTO tblOrderProduct (idOrder, idProduct, intAmount) VALUES (?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('iii', $orderID, $productID, $quantity);
        $stmt->execute();
    }
}

function getOrders($mysqli)
{
    $sql = "SELECT o.ID, o.dtDate, o.strStatus, u.strUserName as strOwnerName FROM tblOrder o
    left join tblUser u on o.idOwner = u.ID";

    $result = $mysqli->query($sql);

    // Initialize an array to hold the orders
    $orders = array();

    // Loop through the orders
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }

    return $orders;
}

function updateOrder($mysqli, $id, $strStatus)
{
    $sql = "UPDATE tblOrder SET strStatus = ? WHERE ID = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('si', $strStatus, $id);
    $stmt->execute();
}

function deleteOrder($mysqli, $id)
{
    $sql = "DELETE FROM tblOrderProduct WHERE idOrder = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $sql = "DELETE FROM tblOrder WHERE ID = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
}