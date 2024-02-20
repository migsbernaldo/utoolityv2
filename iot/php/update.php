<?php
include '../sqlConnection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $UserID = $_POST['userID'] ?? '';
    $fullname = $_POST['fullname'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $userRole = $_POST['userRole'] ?? '';
    // Validate and sanitize the input values if necessary
    // Check if the password field is empty
    if (!empty($password)) {
        // Hash the new password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE `users` SET `Username`='$username',
                                   `Password`='$hashedPassword',
                                   `FullName`='$fullname',
                                   `UserRole`='$userRole'
                                   WHERE `ID` = '$UserID'";
    } else {
        $sql = "UPDATE `users` SET `Username`='$username',
                                   `FullName`='$fullname',
                                   `UserRole`='$userRole'
                                   WHERE `ID` = '$UserID'";
    }
    if ($conn->query($sql) === TRUE) {
        echo "$UserID. Record updated successfully";
        header("Location: ui.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
$conn->close();
?>
