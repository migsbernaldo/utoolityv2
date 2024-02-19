<table id="activity-logs" class="table table-striped" style="background-color: white; width:100%;">
    <thead>
        <tr>
            <th>Date</th>
            <th>FullName</th>
            <th>Activity</th>
            <th>Message</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include 'sqlConnection.php';
        $sqldb = "SELECT logs.Date, users.FullName, activities.ActivityType, LogText FROM logs,users,activities WHERE logs.UserID = users.ID AND logs.ActivityID = activities.ID";
        $result = mysqli_query($conn, $sqldb);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $Date = date("Y-m-d", strtotime($row['Date'])); // Format the date
                $FullName = $row['FullName'];
                $Activity = $row['ActivityType'];
                $Message = $row['LogText'];
                echo '<tr>
            <td>' . $Date . '</td>                                    
            <td>' . $FullName . '</td>
            <td>' . $Activity . '</td>
            <td>' . $Message . '</td>
        </tr>';
            }
        }
        ?>

    </tbody>
</table>