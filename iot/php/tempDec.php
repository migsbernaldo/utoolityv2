<?php
include '../sqlConnection.php';
include 'php/headers.php';
// Check if the connection to the database was successful
if ($conn) {
    // Select the value from the temperature table where the id is 1
    $sql = "SELECT VALUE FROM temperature WHERE ID = 1";
    $result = $conn->query($sql);
    // Get the data from the result object
    $row = $result->fetch_assoc();
    // Convert the data to a string
    $temperature = $row['VALUE'];
    // Update the temperature value by +1, but only until 30
    if ($temperature > 17) {
        $sql = "UPDATE temperature SET VALUE = VALUE - 1 WHERE ID = 1";
        $conn->query($sql);
    }

        $arduino_ip = '192.168.1.120';
        $arduino_port = 8080; // Change this to the port your Arduino is listening on
        $data = 'Temp: Dec';

        // Create a TCP/IP socket connection to the Arduino
        $socket = fsockopen($arduino_ip, $arduino_port, $errno, $errstr, 10);
        if (!$socket) {
            echo "Error: $errstr ($errno)<br>";
        } else {
            // Send the data to the Arduino
            fwrite($socket, $data);
            fclose($socket);    
            echo "Data sent to Arduino: $data<br>";
        }


    session_start();
    $IDS = $_SESSION['ID'];
    $activityID = 7;
    $sql2 = "INSERT INTO logs(UserID, ActivityID, LogText, Timestamp, Date, Time)
    VALUES ($IDS, $activityID, 'success', NOW(), CURDATE(), CURTIME())";
    $conn->query($sql2);
    echo "<script>window.location.replace('../ui.php');</script>";
} else {
    // Display an error message
    echo "Error connecting to the database";
}
