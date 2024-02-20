<?php
include '../sqlConnection.php';
include 'php/headers.php';
$sql = "SELECT ActivityID FROM logs WHERE ActivityID IN (1, 2) ORDER BY Timestamp DESC LIMIT 1"; // Modify the condition as needed
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
