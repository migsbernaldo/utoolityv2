<?php
// Assuming you have established a database connection
include 'sqlConnection.php'; // Include your database connection file
// Retrieve the username from the AJAX request
$username = $_POST['username'];
// Perform a database query to check if the username exists
$query = "SELECT COUNT(*) as count FROM users WHERE Username = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 's', $username);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $count);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);
// Prepare the response as a JSON object
$response = array('exists' => ($count > 0));
// Return the JSON response
header('Content-Type: application/json');
echo json_encode($response);
// Close the database connection
mysqli_close($conn);
?>
