<?php
include 'sqlConnection.php';

// Initialize the start and end dates
$start_date = '';
$end_date = '';
$rows = array(); // Initialize an empty array for rows

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Convert the dates to the appropriate format for database queries or comparisons
    $start_date_formatted = date('Y-m-d', strtotime($start_date));
    $end_date_formatted = date('Y-m-d', strtotime($end_date));

    // Modify your database query to filter results based on the date range
    $query = "SELECT logs.Date, logs.Time, users.FullName, activities.ActivityType, LogText FROM logs, users, activities WHERE logs.UserID = users.ID AND logs.ActivityID = activities.ID AND logs.Date BETWEEN '$start_date_formatted' AND '$end_date_formatted' ORDER BY Date";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>LOGS.php</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#start_date").datepicker({
                dateFormat: 'M-d-yy'
            });
            $("#end_date").datepicker({
                dateFormat: 'M-d-yy'
            });
        });
    </script>
</head>

<body>
    <main>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="start_date">Start Date:</label>
            <input type="text" id="start_date" name="start_date" value="<?php echo $start_date; ?>">

            <label for="end_date">End Date:</label>
            <input type="text" id="end_date" name="end_date" value="<?php echo $end_date; ?>">

            <input type="submit" value="Search">
        </form>

        <?php if ($rows) : ?>
            <h2>Selected Date Range:</h2>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>FullName</th>
                        <th>Activity</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row) : ?>
                        <tr>
                            <td><?php echo date("M-d-Y", strtotime($row['Date'])); ?></td>
                            <td><?php echo date("h:i A", strtotime($row['Time'])); ?></td>
                            <td><?php echo $row['FullName']; ?></td>
                            <td><?php echo $row['ActivityType']; ?></td>
                            <td><?php echo $row['LogText']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No records found for the selected date range.</p>
        <?php endif; ?>
    </main>
</body>

</html>
