<?php
include 'D:/xampp/htdocs/iot/sqlConnection.php';
include 'D:/xampp/htdocs/iot/php/headers.php';
$sql = "SELECT ActivityID FROM logs WHERE ActivityID IN (3, 4) ORDER BY Timestamp DESC LIMIT 1"; // Modify the condition as needed
$result = mysqli_query($conn, $sql);
$columnName = 'ActivityID';
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo $row[$columnName];
    }
} else {
    echo "No results found.";
}
// Close the database connection
mysqli_close($conn);
?>
