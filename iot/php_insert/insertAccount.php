<?php
include 'sqlConnection.php';
function validate($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}
// Handle the confirmation result
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['confirm'])) {
    $confirmation = $_GET['confirm'];
    $username = isset($_GET['username']) ? validate($_GET['username']) : '';
    $fullname = isset($_GET['fullname']) ? validate($_GET['fullname']) : '';
    $userRole = isset($_GET['userRole']) ? validate($_GET['userRole']) : '';
    if ($confirmation == 1) {
        $password = isset($_SESSION['password']) ? $_SESSION['password'] : '';
        createUserAccount($username, $password, $fullname, $userRole);
    } else {
        // Handle cancellation
        header("Location: ui.php");
        exit();
    }
}

$username = isset($_POST['username']) ? validate($_POST['username']) : '';
$password = isset($_POST['password']) ? validate($_POST['password']) : '';
$password_retype = isset($_POST['password_retype']) ? validate($_POST['password_retype']) : '';
$fullname = isset($_POST['fullname']) ? validate($_POST['fullname']) : '';
$userRole = isset($_POST['userRole']) ? validate($_POST['userRole']) : '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['password'], $_POST['password_retype'], $_POST['fullname'])) {
    if (empty($username) || empty($password) || empty($password_retype) || empty($fullname) || empty($userRole)) {
        header("Location: ui.php?error=Please fill in all fields.");
        exit();
    } elseif ($password !== $password_retype) {
        header("Location: ui.php?error=Passwords do not match. Please retype your password correctly.");
        exit();
    } elseif ($userRole !== 'admin' && $userRole !== 'user') {
        header("Location: ui.php?error=Please select a valid user role.");
        exit();
    } else {
        // Check if the username already exists
        $checkQuery = "SELECT COUNT(*) FROM users WHERE Username = '$username'";
        $result = $conn->query($checkQuery);
        $existingUserCount = $result->fetch_row()[0];
        if ($existingUserCount > 0) {
            header("Location: ui.php?error=Username already exists. Please choose a different username.");
            exit();
        } else {
            // Store password in session for use during confirmation
            // session_start();
            $_SESSION['password'] = $password;
            echo <<<HTML
            <script>
                var confirmed = confirm("Are you sure you want to create this account?");
                window.location.href = "ui.php?confirm=" + (confirmed ? "1" : "0") +
                    "&username={$username}&fullname={$fullname}&userRole={$userRole}";
            </script>
            HTML;
            exit();
        }
    }
}

function createUserAccount($username, $password, $fullname, $userRole)
{
    global $conn;
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (Username, Password, Fullname, UserRole, Status)
            VALUES ('$username', '$hashedPassword', '$fullname', '$userRole', 1)";
    if ($conn->query($sql) === TRUE) {
        session_destroy(); // Clean up stored password in session
        header("Location: ui.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
