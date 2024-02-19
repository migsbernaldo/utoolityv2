<?php
// Assuming you have already established a database connection
include 'sqlConnection.php';
// Check the current state
$currentState = mysqli_query($conn, "SELECT State FROM devices WHERE id = 1")->fetch_assoc()['State'];

// Determine the new state based on the current state
$newState = ($currentState === 'on') ? 'off' : 'on';

// Update the state in the database
$sql = "UPDATE devices SET State = '$newState' WHERE id = 1";
if (mysqli_query($conn, $sql)) {
    if ($newState):?>
        <button id="myButton" data-info="<?php var_dump($newState); ?>">Click Me</button>
  <?php endif;
  
} else {
  echo "Error updating database: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>