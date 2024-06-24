<?php
// Include your database connection file and common functions file
include 'database.php';
include 'common-functions.php';

// Get the submitted username and password
$username = $_POST['username'];
$password = $_POST['password'];

// Query the database for the user
$stmt = $mysqli->prepare("SELECT * FROM tblUser WHERE strUsername = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Check if the user exists
if ($user) {
    // Verify the password
    if (password_verify($password, $user['hshPassword'])) {
        // Start the session and store the user's ID in the session
        session_start();
        $_SESSION['uid'] = $user['ID'];
        $_SESSION['uname'] = $user['strUsername'];
        $_SESSION['admin'] = $user['blAdmin'];
        $_SESSION['cart'] = array();

        // Redirect to the home page
        header("Location: index.php");
    } else {
        // Password is incorrect
        echo "Incorrect password.";
    }
} else {
    // User does not exist
    echo "User does not exist.";
}

$stmt->close();
$mysqli->close();
?>