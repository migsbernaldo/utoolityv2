<?php
include 'D:/xampp/htdocs/iot/php/headers.php';
    // Database credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "utoolity";
    // Establish the database connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>