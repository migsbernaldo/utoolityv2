<?php
include '../sqlConnection.php'; // Include your database connection file
if (isset($_POST['userID'])) {
    $userID = $_POST['userID'];
    // Check the current status of the user
    $checkStatusQuery = "SELECT Status FROM users WHERE ID = $userID Order by ID ASC";
    $checkStatusResult = mysqli_query($conn, $checkStatusQuery);
    if ($checkStatusResult) {
        $row = mysqli_fetch_assoc($checkStatusResult);
        $currentStatus = $row['Status'];
        // Toggle the status
        $newStatus = ($currentStatus == 0) ? 1 : 0;
        // Update the status
        $updateStatusQuery = "UPDATE users SET Status = $newStatus WHERE ID = $userID";
        $updateStatusResult = mysqli_query($conn, $updateStatusQuery);
        if ($updateStatusResult) {
            echo "Status updated successfully.";
            exit();
        } else {
            echo "Error updating status: " . mysqli_error($conn);
        }
    } else {
        echo "Error checking status: " . mysqli_error($conn);
    }
    mysqli_free_result($checkStatusResult);
} else {
    echo "No user ID provided.";
}
// Additional code to disable or hide the logged-in user
if (isset($_SESSION['userID'])) {
    $loggedInUserID = $_SESSION['userID'];
    // Disable or hide the button or user based on the logged-in user
    echo "<script>
        $(document).ready(function() {
            $('input[value=\"$loggedInUserID\"]').siblings('.toggleButton').prop('disabled', true);
            $('input[value=\"$loggedInUserID\"]').parents('tr').hide();
        });
    </script>";
}
?>