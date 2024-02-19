<?php

// Database configuration
$dbHost = 'localhost'; // Change this to your MySQL hostname
$dbUsername = 'root'; // Change this to your MySQL username
$dbPassword = ''; // Change this to your MySQL password
$dbName = 'swiss_collection'; // Change this to your MySQL database name

// Create connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
