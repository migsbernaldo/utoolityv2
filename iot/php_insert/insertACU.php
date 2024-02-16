<?php
session_start();
include 'D:/xampp/htdocs/iot/sqlConnection.php';
$IDS = $_SESSION['ID'];
$activityID = 1;
// Query to check if there is any record with ActivityID = 1 or 2
$checkQuery = "SELECT ActivityID FROM logs WHERE ActivityID IN (1, 2) ORDER BY Timestamp DESC LIMIT 1";
$result = $conn->query($checkQuery);
if ($result->num_rows > 0) {
    // Fetch the last inserted activity ID
    $lastActivityID = $result->fetch_assoc()['ActivityID'];
    // Alternate the activity ID based on the last inserted value
    if ($lastActivityID == 1) {
        $activityID = 2;
    } else {
        $activityID = 1;
    }
}

$sql2 = "INSERT INTO logs(UserID, ActivityID, LogText, Timestamp, Date, Time)
VALUES ($IDS, $activityID, 'success', NOW(), CURDATE(), CURTIME())";
$conn->query($sql2);
// var_dump($sql2);
echo '<script>window.location.replace("http://iot.comteq.edu.ph/iot/ui.php");</script>'; 
$conn->close();
?>
