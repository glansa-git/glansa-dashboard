<?php

// Database configuration
$host = '158.220.124.111'; // Change this to your database host
$dbname = 'dashboar_glansa'; // Change this to your database name
$username = 'dashboar_glansa'; // Change this to your database username
$password = 'dashboar_glansa'; // Change this to your database password

// Attempt database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Connection successful
// echo "Connected successfully";

?>