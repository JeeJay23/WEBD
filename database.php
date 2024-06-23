<?php
// Database connection
$host = 'localhost';
$db   = 'test';
$user = 'username';
$pass = 'password';
$charset = 'utf8mb4';

// $mysqli = new mysqli($host, $user, $pass, $db);
$mysqli = new mysqli($host, "root", "", $db);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

?>