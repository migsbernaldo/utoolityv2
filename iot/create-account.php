<?php

session_start();

include 'sqlConnection.php';
include 'php_insert/insertAccount.php';
include 'php/headers.php';
$userRole = isset($_POST['UserRole']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/img/utoolity-icon.png">

    <link rel="stylesheet" href="assets/css/create-account.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Create Account - uTOOLity</title>
</head>

<body>
    <main>
        <div class="container create-acc">
            <div class="col-4 create-form">
                <h2>Create Account</h2>
                <form method="POST" action="create-account.php">
                    <?php if (isset($_GET['error'])) { ?>
                        <style>
                            form .error {
                                background-color: red !important;
                                padding: 0.2em !important;
                                font-size: 1em;
                            }
                        </style>
                        <p class="error">
                            <?php echo $_GET['error']; ?>
                        </p>
                    <?php } ?>

                    <label for="fullname">Full Name</label>
                    <input type="text" id="fullname" name="fullname">

                    <label for="username">Username</label>
                    <input type="text" id="username" name="username">

                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">

                    <label for="password_retype">Confirm Password:</label>
                    <input type="password" name="password_retype" id="password_retype">

                    <select class="form-control" name="userRole" id="userRole">
                        <option>Select User Role</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>

                    <input id="submit" type="submit" value="Submit">
                </form>
            </div>

            <div class="col-8">
                <table id="create-account" class="table table-striped" style="background-color: white; width:100%;">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>User Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $userRole = isset($_POST['userRole']);
                        $sqldb = "SELECT Username, FullName, UserRole, ID, Status FROM users";
                        $result = mysqli_query($conn, $sqldb);

                        if ($result) {
                            if (mysqli_num_rows($result) > 0) {
                                // Fetch all rows as an associative array
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $Username = $row['Username'];
                                    $FullName = $row['FullName'];
                                    $UserRole = $row['UserRole'];
                                    $UserID = $row['ID']; // Get the ID of the user
                                    $Status = $row['Status']; // Get the status of the user
                        
                                    $buttonColorClass = ($Status == 1) ? 'btn-success' : 'btn-danger';
                                    $buttonText = ($Status == 1) ? 'Enable' : 'Disable';

                                    echo '<tr>
                            <td>' . $FullName . '</td>
                            <td>' . $Username . '</td>
                            <td>' . $UserRole . '</td>
                            <td id="actionGrp">
                                <button id="editBtn" type="button" class="btn btn-success enableBtn" title="Edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit"></i></button>
                                <form class="toggleForm">
                                    <input type="hidden" name="userID" value="' . $UserID . '">
                                    <button type="submit" class="toggleButton btn ' . $buttonColorClass . '" title="Toggle Status">' . $buttonText . '</button>
                                </form>
                            </td>
                        </tr>';
                                }
                            } else {
                                echo '<tr><td colspan="4">No rows found.</td></tr>';
                            }
                            mysqli_free_result($result);
                        } else {
                            echo '<tr><td colspan="4">Error: ' . mysqli_error($conn) . '</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
                </table>
            </div>
        </div>
    </main>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/fontawesome-free-6.4.0-web/js/all.js"></script>
    <!-- <script src="assets/js/command.js"></script> -->
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JavaScript -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {

            var table = $('#create-account').DataTable({

            });

        });

        $(document).ready(function () {
            $(".toggleForm").submit(function (event) {
                event.preventDefault();
                var userID = $(this).find("input[name='userID']").val();
                $.post('php/enabdisab.php', { userID: userID }, function (response) {
                    console.log(response);
                    var button = $("input[value='" + userID + "']").siblings(".toggleButton");
                    button.toggleClass("btn-success btn-danger");
                    button.text(button.text() === "Enable" ? "Disable" : "Enable");
                }).fail(function (xhr, status, error) {
                    console.log(error);
                });
            });
        });
    </script>
</body>

</html>