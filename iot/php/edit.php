<?php
include 'D:/xampp/htdocs/iot/sqlConnection.php';
if (isset($_GET['userID'])) {
    $userID = $_GET['userID'];
    // Perform the database query
    $sql = "SELECT `ID`, `Username`, `Password`, `FullName`, `UserRole`, `Status` FROM `users` WHERE ID = $userID";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        // Decrypt the hashed password value (not recommended for security reasons)
        $decryptedPassword = $data['Password'];
        // Add the decrypted password to the data array
        $data['DecryptedPassword'] = $decryptedPassword;
        echo json_encode($data);
    } else {
        echo "No data found";
    }
    $conn->close();
}
?>
