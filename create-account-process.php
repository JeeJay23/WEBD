<?php
// Include your database connection file and common functions file
include 'database.php';
include 'common-functions.php';

// Get the submitted username and password
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert the user into the database
$stmt = $mysqli->prepare("INSERT INTO tblUser (strUsername, hshPassword, strEmail, blAdmin) VALUES (?, ?, ?, true)");
$stmt->bind_param("sss", $username, $hashedPassword, $email);
$stmt->execute();

// check if the user was created
if ($stmt->affected_rows > 0) {
    // Redirect to the login page
    header("Location: login.php");
} else {
    // Display an error message
    echo "Error creating user.";
}

// Redirect to the login page
header("Location: login.php");
?>