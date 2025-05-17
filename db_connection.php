<?php
// db_connection.php

// Define your database credentials
$host = "localhost";  // or your server IP
$username = "root";   // your MySQL username
$password = "";       // your MySQL password
$dbname = "magic_evenza";  // your database name

// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
