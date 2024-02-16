<?php
include 'D:/xampp/htdocs/iot/sqlConnection.php';
include 'D:/xampp/htdocs/iot/php_insert/insertAccount.php';
include 'D:/xampp/htdocs/iot/php/headers.php';
session_start();
if (isset($_SESSION['ID']) && isset($_SESSION['Username'])) {

    header("Referrer-Policy: strict-origin-when-cross-origin");

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="assets/img/utoolity-icon.png">

        <!-- DataTables CSS -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
        <!-- DataTables Buttons CSS -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">

        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/header.css">
        <link rel="stylesheet" href="assets/css/activity-logs.css">

        <title>Activity Logs - uTOOLity</title>
    </head>

    <body>
        <main>
            <div class="container">
                <div class="col-10">
                    <h2>Activity Logs</h2>
                    <table id="activity-logs" class="table table-striped" style="background-color: white; width: 100%;">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>FullName</th>
                                <th>Activity</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php        
                          $sqldb = "SELECT logs.Date, users.FullName, activities.ActivityType, LogText FROM logs,users,activities WHERE logs.UserID = users.ID AND logs.ActivityID = activities.ID";
                          $result = mysqli_query($conn, $sqldb);

                          if ($result && mysqli_num_rows($result) > 0) {
                              while ($row = mysqli_fetch_assoc($result)) {
                                  $Date = date("m d Y", strtotime($row['Date']));
                                  // $Time = date("h:i A", strtotime($row['Time']));
                                  $FullName = $row['FullName'];
                                  $Activity = $row['ActivityType'];
                                  $Message = $row['LogText'];
                                  echo '<tr>
                                  <td data-order="' . $Date . '">' . $Date . '</td>                                    
                                  <td>' . $FullName . '</td>
                                  <td>' . $Activity . '</td>
                                  <td>' . $Message . '</td>
                                  </tr>';
                              }
                          }

                           mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- DataTables JavaScript -->
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <!-- DataTables Buttons JavaScript -->
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>

        <!-- DataTables Buttons PDF library -->
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
        <!-- DataTables Buttons Print library -->
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#activity-logs').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'print',
                            title: '<div class="container justify-content-center" style="line-height:5px; font-size:16px;"> <div class="row"> <div class="col-md-3"> <img src="assets/img/comteq_logo3.png" alt="Comteq Logo" width="220" height="55"> </div> <div class="col-md-9 mt-1"> <div class="row"> <p style="color: #05517a;">COMTEQ COMPUTER AND BUSINESS COLLEGE, INC.</p> </div> <div class="row"> <p>SAVERS BUILDING, #1200 Rizal Ave., Ext., East Tapinac Olongapo CIty, Zambales, Philippines</p> </div> <div class="row"> <p>Mobile No.: 09770163443/09293110963 | Tel No. (047) 602 4778</p> </div> </div> </div> </div> <hr style="border: 1px solid black;"></hr>',
                            orientation: 'landscape',
                            text: '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" fill="#1e3583"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M128 0C92.7 0 64 28.7 64 64v96h64V64H354.7L384 93.3V160h64V93.3c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0H128zM384 352v32 64H128V384 368 352H384zm64 32h32c17.7 0 32-14.3 32-32V256c0-35.3-28.7-64-64-64H64c-35.3 0-64 28.7-64 64v96c0 17.7 14.3 32 32 32H64v64c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V384zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg>',
                            className: 'btn btn-primary',
                            exportOptions: {
                                stripHtml: false
                            }
                        },
                        {
                            extend: 'pdf',
                            text: 'Export to PDF',
                            className: 'btn btn-primary'
                        }
                    ],
                    responsive: true
                });
            });
        </script>
    </body>

</html>
<?php
} else {

    header("Location: login.php");
    exit();
}
?>