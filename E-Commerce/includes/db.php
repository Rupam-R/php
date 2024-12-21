<?php
// db.php - Database connection
$servername = "localhost";
$username = "root"; // Change this based on your database config
$password = ""; // Change this based on your database config
$dbname = "ecommerce"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
