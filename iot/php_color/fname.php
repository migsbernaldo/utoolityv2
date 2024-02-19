<?php
session_start();
include 'sqlConnection.php';
include 'php/headers.php';
if (isset($_SESSION['ID'])) {
    $ID = $_SESSION['ID'];
    $sql = "SELECT FullName FROM users WHERE ID = $ID";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $fullName = $row['FullName'];
        echo $fullName;
    } else {
        echo "Error: Unable to fetch data from the database.";
    }
}
?>
