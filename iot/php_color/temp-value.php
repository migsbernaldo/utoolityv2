<?php
include 'D:/xampp/htdocs/iot/sqlConnection.php';
include 'D:/xampp/htdocs/iot/php/headers.php';
$sql = "SELECT VALUE FROM temperature WHERE ID = 1";
$result = $conn->query($sql);
// Get the data from the result object
$row = $result->fetch_assoc();
// Convert the data to a string
$temperature = $row['VALUE'];
echo $temperature;
?>