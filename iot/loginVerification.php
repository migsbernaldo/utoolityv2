<?php
session_start();
include 'sqlConnection.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (empty($username)) {
        $_SESSION['error'] = "User Name is required";
    } elseif (empty($password)) {
        $_SESSION['error'] = "Password is required";
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE Username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row['Password'];
            $userStatus = $row['Status'];
            if ($userStatus == 0) {
                $_SESSION['error'] = "Your account is disabled. Please contact the administrator.";
            } elseif (password_verify($password, $hashedPassword)) {
                $_SESSION['Username'] = $row['Username'];
                $_SESSION['ID'] = $row['ID'];
                $_SESSION['UserRole'] = $row['UserRole'];
                header("Location: ui.php");
                exit();
            } else {
                $_SESSION['error'] = "Incorrect Password";
            }
        } else {
            $_SESSION['error'] = "User does not exist";
        }
    }
    // Store the entered username for retaining the input value
    $_SESSION['usernameInput'] = $username;
    header("Location: login.php");
    exit();
} else {
    header("Location: login.php");
    exit();
}
?>
