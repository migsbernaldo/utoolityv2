<?php
include 'php/headers.php';
    // Database credentials
    $servername = "localhost";
    $username = "utoolityv2";
    $password = "Ccbc-2024";
    $dbname = "utoolity";
    // Establish the database connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>
