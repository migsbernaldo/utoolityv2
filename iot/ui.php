<?php
include 'sqlConnection.php';
include 'php_insert/insertAccount.php';
include 'php/headers.php';
session_start();
if (isset($_SESSION['ID']) && isset($_SESSION['Username'])) {
    // User is logged in
    $userRole = $_SESSION['UserRole'];
    // Check if the user is an admin
    $isAdmin = ($userRole === 'admin');
    $isUser = ($userRole === 'user');

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>uTOOLity</title>
        <link rel="icon" type="image/x-icon" href="assets/img/utoolity-icon.png">
        <link type="text/css" href="assets/css/fontawesome.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="assets/css/loading.css">
        <!-- DataTables CSS -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
        <!-- DataTables Buttons CSS -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/create-account.css">
        <link rel="stylesheet" type="text/css" href="assets/css/header.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.css" />
    </head>

    <body>
        <header class="fixed-top">
            <div class="collapse bg-dark header-desktop" id="navbarHeader">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-md-7 button-group">
                            <h4 class="text-white">About</h4>
                            <p class="text-muted">
                                <strong>uTOOLity</strong> is an innovative IoT device developed as a thesis project by
                                a team of talented 4th year students pursuing a Bachelor of
                                Science in Computer Science at <a id="comteq-link" href="https://lms.comteq.edu.ph">Comteq
                                    Computer and Business College</a>.
                                The group of developers behind uTOOLity consists of Clarisse Aratan, Angelo B. Joaquin,
                                Kenneth I. Lopez,
                                John Kenneth Q. Morga, and <a href="https://www.facebook.com/aroweniel">Ronel Rae M.
                                    Rafael</a>.
                            </p>
                        </div>
                        <div class="col-sm-4 offset-md-1 py-4">
                            <ul class="list-unstyled command-list">
                                <?php if ($isAdmin) { ?>
                                    <li>
                                        <button id="act-logs" class="btn btn-secondary" title="Activity Logs" data-bs-toggle="modal" data-bs-target="#act-logs-modal" data-bs-backdrop="static" data-bs-keyboard="false"><i class="fa fa-list"></i></button>
                                    </li>
                                    <li>
                                        <button id="create-user" class="btn btn-secondary" title="Create User" data-bs-toggle="modal" data-bs-target="#create-account-modal"><i class="fa fa-users"></i></button>
                                    </li>
                                    <li>
                                        <form action="http://iot.comteq.edu.ph/iot/logout.php" method="post">
                                            <button id="userlogout" class="btn btn-secondary" name="submit" title="Sign Out" style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important;" value="Execute PHP File">
                                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </li>
                                <?php } elseif ($isUser) { ?>
                                    <li>
                                        <form action="http://iot.comteq.edu.ph/iot/logout.php" method="post">
                                            <button id="userlogout" class="btn btn-secondary" name="submit" title="Sign Out" value="Execute PHP File" style="border-top-left-radius: .5em !important; border-bottom-left-radius: .5em !important;">
                                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="collapse bg-dark header-mobile" id="navbarHeader">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 offset-md-1 py-4">
                            <div id="welcome-user-mobile">
                                <p class="welcome">Welcome,&nbsp;</p>
                                <p id="user-mobile"></p>
                            </div>
                            <ul class="list-unstyled command-list">
                                <?php if ($isAdmin) { ?>
                                    <li>
                                        <button id="act-logs" class="btn btn-secondary" title="Activity Logs" data-bs-toggle="modal" data-bs-target="#act-logs-modal"><i class="fa fa-list"></i></button>
                                    </li>
                                    <li>
                                        <button id="create-user" class="btn btn-secondary" title="Create User" data-bs-toggle="modal" data-bs-target="#create-account-modal"><i class="fa fa-users"></i></button>
                                    </li>
                                    <li>
                                        <form action="http://iot.comteq.edu.ph/iot/logout.php" method="post">
                                            <button id="userlogout" class="btn btn-secondary" name="submit" title="Sign Out" style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important;" value="Execute PHP File">
                                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </li>
                                <?php } elseif ($isUser) { ?>
                                    <li>
                                        <form action="http://iot.comteq.edu.ph/iot/logout.php" method="post">
                                            <button id="userlogout" class="btn btn-secondary" name="submit" title="Sign Out" value="Execute PHP File" style="border-top-left-radius: .5em !important; border-bottom-left-radius: .5em !important;">
                                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="navbar navbar-dark bg-dark box-shadow">
                <div class="container d-flex justify-content-between">
                    <a class="navbar-brand d-flex align-items-center">
                        <img src="assets/img/utoolity-logo.png" alt="uTOOLity" width="250px">
                    </a>
                    <ul class="list-unstyled command-list">
                        <li id="welcome-user-desktop">
                            <p class="welcome">Welcome,&nbsp;</p>
                            <p id="user"></p>
                        </li>
                        <li>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <main role="main" class="con-body">
            <div class="desktop row h-100 ">
                <div class="shape"></div>
                <div class="col-5 control-col circle">
                    <h2 id="room-number">ROOM 409</h2>
                    <p id="power-control-label">Power Control</p>
                    <div id="ac-breaker">
                        <form action="http://iot.comteq.edu.ph/iot/php_insert/insertACU.php" method="post">
                            <button id="ACUBreakerButton" class="btn btn-success" name="submit" value="Execute PHP File"><i class="fa fa-bolt" aria-hidden="true"></i></button>
                        </form>
                        <p>ACU</p>
                    </div>
                    <div id="light-breaker">
                        <form action="http://iot.comteq.edu.ph/iot/php_insert/insertLights.php" method="post">
                            <button id="LightBreakerButton" class="btn btn-success" name="submit" value="Execute PHP File"><i class="fa fa-lightbulb" aria-hidden="true"></i></button>
                        </form>
                        <p>Lights</p>
                    </div>
                </div>
                <div class="col col-xs-12 remote-col">
                    <div class="card">
                        <div id="temp-row" class="card-header">
                            <div class="cont-desktop">
                                <p class="remote-icon" id="remote-icon"><i class="fa fa-tower-broadcast"></i></p>
                                <div class="row">
                                    <p id="temp-label">Temperature</p>
                                    <div id="temp-row2">
                                        <p class="degree-decoy">°</p>
                                        <p id="temp-val-d"></p>
                                        <p>°</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="btn-group temp-group">
                                        <form action="http://iot.comteq.edu.ph/iot/php/tempDec.php" method="post">
                                            <button id="TempDecButton" class="btn btn-light" name="submit" value="Execute PHP File"><i class="fa fa-solid fa-caret-down"></i></button>
                                        </form>
                                        <form action="http://iot.comteq.edu.ph/iot/php/tempInc.php" method="post">
                                            <button id="TempIncButton" class="btn btn-light" name="submit" value="Execute PHP File"><i class="fa fa-solid fa-caret-up"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body remote-col">
                            <div class="row remote-main">
                                <div id="power-col">
                                    <form action="http://iot.comteq.edu.ph/iot/php_insert/insertRemote.php" method="post">
                                        <button id="RemoteButton" class="btn btn-light" name="submit" value="Execute PHP File"><i class="fa fa-solid fa-power-off"></i></button>
                                    </form>
                                    <p id="power-label">Power</p>
                                </div>
                                <div id="pair-col">
                                    <button id="PairingButton" class="btn btn-light" document.body.style.pointerEvents='none' ;><i class='fa fa-sync fa-rotate-90'></i>
                                    </button>
                                    <div id="loading-container" style="display: none;">
                                        <div class="loading-animation">
                                            <div class="loading-icon">
                                                <img src="assets/img/utoolity-icon.png" alt="">
                                                <p>Pairing...</p>
                                            </div>
                                        </div>
                                    </div>
                                    <p id="pair-label">Pair</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mobile row h-100 main-container">
                <div class="col col-xs-12 remote-col">
                    <div class="shape row">
                        <div class="control-col-mobile circle">
                            <div class="row control-row">
                                <div id="ac-breaker">
                                    <form action="http://iot.comteq.edu.ph/iot/php_insert/insertACU.php" method="post">
                                        <button id="ACUBreakerButtonM" class="btn btn-success" name="submit" value="Execute PHP File"><i class="fa fa-bolt" aria-hidden="true"></i></button>
                                    </form>
                                    <p>ACU</p>
                                </div>
                                <div id="light-breaker">
                                    <form action="http://iot.comteq.edu.ph/iot/php_insert/insertLights.php" method="post">
                                        <button id="LightBreakerButtonM" class="btn btn-success" name="submit" value="Execute PHP File"><i class="fa fa-lightbulb" aria-hidden="true"></i></button>
                                    </form>
                                    <p>Lights</p>
                                </div>
                            </div>
                            <div class="row cont-mobile">
                                <p class="remote-icon" id="remote-iconM"><i class="fa fa-tower-broadcast"></i></p>
                                <div class="row">
                                    <p id="temp-label">Temperature</p>
                                    <div id="temp-row2">
                                        <p class="degree-decoy">°</p>
                                        <p id="temp-val-m">17</p>
                                        <p>°</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="btn-group temp-group">
                                        <form action="http://iot.comteq.edu.ph/iot/php/tempDec.php" method="post">
                                            <button id="TempDecButtonM" class="btn btn-dark" name="submit" value="Execute PHP File"><i class="fa fa-solid fa-caret-down"></i></button>
                                        </form>
                                        <form action="http://iot.comteq.edu.ph/iot/php/tempInc.php" method="post">
                                            <button id="TempIncButtonM" class="btn btn-dark" name="submit" value="Execute PHP File"><i class="fa fa-solid fa-caret-up"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body remote-col">
                            <div class="row remote-main">
                                <div id="power-col">
                                    <form action="http://iot.comteq.edu.ph/iot/php_insert/insertRemote.php" method="post">
                                        <button id="RemoteButtonM" class="btn btn-light" name="submit" value="Execute PHP File"><i class="fa fa-solid fa-power-off"></i></button>
                                    </form>
                                    <p id="power-label">Power</p>
                                </div>
                                <div id="pair-col">
                                    <button id="PairingButtonM" class="btn btn-light" document.body.style.pointerEvents='none' ;><i class='fa fa-sync fa-rotate-90'></i>
                                    </button>
                                    <div id="loading-container" style="display: none;">
                                        <div class="loading-animation">
                                            <div class="loading-icon">
                                                <img src="assets/img/utoolity-icon.png" alt="">
                                                <p>Pairing...</p>
                                            </div>
                                        </div>
                                    </div>
                                    <p id="pair-label">Pair</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="act-logs-modal" tabindex="-1" role="dialog" aria-labelledby="activityLogsTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="activityLogsTitle">Activity Logs</h2>
                            <button type="button" class="close btn-dark" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive actlog-container">
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
                                        $sqldb = "SELECT logs.Date, users.FullName, activities.ActivityType, LogText FROM logs,users,activities WHERE logs.UserID = users.ID AND logs.ActivityID = activities.ID";
                                        $result = mysqli_query($conn, $sqldb);
                                        if ($result && mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $Date = date("m d Y", strtotime($row['Date'])); // Format the date
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="create-account-modal" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="createFormTitle">Account List</h2>
                            <button type="button" class="close btn-dark" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body create-acc row">
                            <div class="col-12 table-responsive create-acc-container">
                                <table id="create-account" class="table table-striped" style="background-color: white; width: 100%;">
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
                                                    $buttonIcon = ($Status == 1) ? "<i class='fa fa-user'></i>" : "<i class='fa fa-user-lock'></i>";
                                                    $disabledAttribute = ($UserID == $_SESSION['ID']) ? 'disabled' : ''; // Check if $UserID matches $_SESSION['ID'];

                                                    echo '<tr>
                                                        <td>' . $FullName . '</td>
                                                        <td>' . $Username . '</td>
                                                        <td>' . $UserRole . '</td>
                                                        <td id="actionGrp">
                                                            <button id="editBtn-' . $UserID . '" type="button" class="btn btn-success enableBtn editBtn" title="Edit" data-bs-toggle="modal" data-bs-target="#editModal" onclick="getDataFromDatabase(' . $UserID . ')"><i class="fa fa-edit"></i></button>
                                                            <form class="toggleForm">
                                                                <input type="hidden" name="userID" value="' . $UserID . '">
                                                                <button id="susBtn-' . $UserID . '" type="submit" class="toggleButton btn ' . $buttonColorClass . ' susBtn" title="Toggle Status" ' . $disabledAttribute . '>' . $buttonIcon . '</button>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="suspendModal" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="suspendTitle">Suspend Account</h5>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to suspend this user?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger">Suspend</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="createModal" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalTitle">Create Account</h5>
                            <button type="button" class="close btn-dark" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body create-form">
                            <form method="POST" id="myForm" action="ui.php">
                                <label for="fullname">Full Name</label>
                                <input type="text" id="fullname" name="fullname" required>

                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" required>
                                <p class="d-none" id="username-error" style="color: rgb(172, 6, 0)">Username Already Exist
                                </p>
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" required>

                                <label for="password_retype">Confirm Password:</label>
                                <input type="password" name="password_retype" id="password_retype" required>
                                <p class="error-message d-none text-danger">Passwords do not match. Please retype your
                                    password correctly.</p>

                                <div class="col-5">
                                    <select class="form-control" name="userRole" id="userRole" required>
                                        <option>Select User Role</option>
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>

                                <?php if (isset($_GET['error'])) { ?>
                                    <style>
                                        form .error {
                                            background: white !important;
                                            color: red !important;
                                            padding: 0.2em !important;
                                            font-size: 1em;
                                        }
                                    </style>
                                    <p class="error">
                                        <?php echo $_GET['error']; ?>
                                    </p>
                                <?php } ?>
                                <input id="submit" type="submit" value="Submit">
                            </form>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal fade" id="editModal" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalTitle">Edit Account</h5>
                            <button type="button" class="close btn-dark" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body create-form">
                            <form method="POST" id="editForm" action="http://iot.comteq.edu.ph/iot/php/update.php">
                                <input hidden=true name="userID" id="userID" value="<?php echo $UserID; ?>">

                                <label for="fullname">Full Name</label>
                                <input type="text" id="fullnameEdit" name="fullname" required>

                                <label for="username">Username</label>
                                <input type="text" id="usernameEdit" name="username" required>
                                <p class="d-none" id="username-error" style="color: rgb(172, 6, 0)">Username Already Exist
                                </p>
                                <label for="password">Password</label>
                                <input type="password" id="passwordEdit" name="password">
                                <input hidden=tru id="tryEdit" name="tryEdit">
                                <p class="error-message d-none text-danger">Passwords do not match. Please retype your
                                    password correctly.</p>

                                <label for="password_retype">Confirm Password:</label>
                                <input type="password" name="password_retypeEdit" id="password_retypeEdit">

                                <div class="col-5">
                                    <select class="form-control" name="userRole" id="userRoleEdit" required>
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>

                                </div>

                                <?php if (isset($_GET['error'])) { ?>
                                    <style>
                                        form .error {
                                            background: white !important;
                                            color: red !important;
                                            padding: 0.2em !important;
                                            font-size: 1em;
                                        }
                                    </style>
                                    <p class="error">
                                        <?php echo $_GET['error']; ?>
                                    </p>
                                <?php } ?>
                                <input id="submitEdit" type="submit" value="Update">
                            </form>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/fontawesome-free-6.4.0-web/js/all.js"></script>
        <script src="assets/js/command.js"></script>
        <script src="assets/js/dataTables.bootstrap5.min.js"></script>
        <script type="text/javascript" src="assets/js/jquery-3.5.1.js"></script>
        <!-- DataTables JavaScript -->
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <!-- DataTables Buttons JavaScript -->
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
        <!-- DataTables Buttons PDF library -->
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
        <!-- DataTables Buttons Print library -->
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
        </script>

        <script>
            $(document).ready(function() {
                // Initialize DataTable
                var table = $('#activity-logs').DataTable({
                    dom: '<"row"<"col-md-6 searchDate float-left"fr><"col-md-2"l><"col-md-4 button-col"B>>rtip',
                    buttons: [{
                            text: '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" fill="#1e3583"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M128 0C92.7 0 64 28.7 64 64v96h64V64H354.7L384 93.3V160h64V93.3c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0H128zM384 352v32 64H128V384 368 352H384zm64 32h32c17.7 0 32-14.3 32-32V256c0-35.3-28.7-64-64-64H64c-35.3 0-64 28.7-64 64v96c0 17.7 14.3 32 32 32H64v64c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V384zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg>',
                            className: 'btn btn-primary',
                            extend: 'print',
                            // title: '<div class="container justify-content-center" style="line-height:5px; font-size:16px;"> <div class="row"> <div class="col-md-3"> <img src="assets/img/comteq_logo3.png" alt="Comteq Logo" width="220" height="55"> </div> <div class="col-md-9 mt-1"> <div class="row"> <p style="color: #05517a;">COMTEQ COMPUTER AND BUSINESS COLLEGE, INC.</p> </div> <div class="row"> <p>SAVERS BUILDING, #1200 Rizal Ave., Ext., East Tapinac Olongapo CIty, Zambales, Philippines</p> </div> <div class="row"> <p>Mobile No.: 09770163443/09293110963 | Tel No. (047) 602 4778</p> </div> </div> </div> </div> <hr style="border: 1px solid black;"></hr>',
                            customize: function(win) {
                                var logo = '<img src="http://iot.comteq.edu.ph/iot/assets/img/comteq_logo3.png" alt="Comteq Logo" width="220" height="55">';
                                var header = '<div style="text-align: left; line-height: 1em; font-size: 16px;">' + logo + '</div>' +
                                    '<div style="text-align: left; line-height: 1em; font-size: 16px;">' +
                                    '<div style="line-height: 1em;">COMTEQ COMPUTER AND BUSINESS COLLEGE, INC.</div>' +
                                    '<div style="line-height: 1em;>SAVERS BUILDING, #1200 Rizal Ave., Ext., East Tapinac Olongapo CIty, Zambales, Philippines</div>' +
                                    '<div style="line-height: 1em;>Mobile No.: 09770163443/09293110963 | Tel No. (047) 602 4778</div>' +
                                    '</div style="line-height: 1em;>' +
                                    '<hr style="border: 1px solid black;">';
                                $(win.document.body).prepend(header);
                                $(win.document.body).find('h1').css('font-size', '16px');
                                $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
                                $(win.document.body).find('div.print-footer').html(''); // Set the footer content to empty string
                            },
                        },
                        {
                            text: 'Export to PDF',
                            className: 'btn btn-primary',
                            extend: 'pdf'
                        }
                    ],
                    responsive: true,
                    searching: true,
                    order: [0, 'desc'],
                    columnDefs: [{
                        type: 'date-moment',
                        targets: 0
                    }], // Apply custom sorting to the first column (Date)
                });

                $('#create-account').DataTable({
                    dom: '<"row"<"col-8 searchDate float-left"fr><"col-4 button-col"B>>rtip',
                    buttons: [{
                        text: '<i class="fa fa-plus"></i>',
                        className: 'btn addAccBtn',
                        title: 'Edit',
                        attr: {
                            'data-bs-toggle': 'modal',
                            'data-bs-target': '#createModal',
                            'title': 'Add Account'
                        },
                        action: function(e, dt, node, config) {
                            // Handle button click event
                            // Add your desired functionality here
                            console.log("Edit button clicked");
                        }
                    }],
                    responsive: true
                });

                // Move the button container to the right
                var buttonContainer = $('.dt-buttons');
                buttonContainer.addClass('float-right');

                // Modify the search bar container
                var searchContainer = $('.dataTables_filter');
                searchContainer.addClass('col-md-4 float-left searchContainer');
                searchContainer.css('margin-top', '8px');

                // Move the print button to the right
                var printButton = buttonContainer.find('.buttons-print');
                printButton.addClass('');



                var lengthMenu = $('.dataTables_length');
                lengthMenu.remove();
                ///////////////////////////////////username checker////////////////////////////////////////////////////////////////////

                $('#username').keyup(function() {
                    var username = $(this).val();

                    $.post('/iot/php/check_username.php', {
                            username: username
                        })
                        .done(function(response) {
                            // Update the #username-error element based on the response
                            if (response.exists == false) {
                                $('#username-error').addClass('d-none');
                                $('#submit').prop('disabled', false);

                            } else {
                                $('#username-error').removeClass('d-none');
                                $('#submit').prop('disabled', true);

                            }
                        })
                        .fail(function(jqXHR, textStatus, errorThrown) {
                            // Log an error message to the console if the request fails
                            console.log('AJAX Error: ' + textStatus + ' - ' + errorThrown);
                        })
                        .always(function() {
                            console.log('AJAX request completed.');
                        });
                });

                $('#password_retype').on('keyup', function() {
                    var password = $('#password').val();

                    if (password == $(this).val()) {
                        $('.error-message').addClass('d-none');
                        $('#submit').prop('disabled', false);

                    } else {
                        $('.error-message').removeClass('d-none');
                        $('#submit').prop('disabled', true);

                    }
                });

                $('#password_retypeEdit').keyup(function() {
                    var password = $('#passwordEdit').val();

                    if (password == $(this).val()) {
                        $('.error-message').addClass('d-none');
                        $('#submitEdit').prop('disabled', false);
                    } else {
                        $('.error-message').removeClass('d-none');
                        $('#submitEdit').prop('disabled', true);
                    }
                });

                function validateUserRole() {
                    var selectedRole = document.getElementById("userRole").value;
                    var submitButton = document.getElementById("submit");

                    if (selectedRole === "Select User Role") {
                        submitButton.disabled = true;
                    } else {
                        submitButton.disabled = false;
                    }
                }
                //////////////////////////////////////////////submition//////////////////////////////////////////////////////////////////////////
            });
        </script>

        <script>
            ////////////////////////////////////////////////enable disable///////////////////////////////////////////////////////////////
            $(document).ready(function() {
                $(".toggleForm").submit(function(event) {
                    event.preventDefault();
                    var userID = $(this).find("input[name='userID']").val();

                    // Show confirmation dialog
                    if (confirm("Are you sure you want to change the account's status?")) {
                        $.post('php/enabdisab.php', {
                            userID: userID
                        }, function(response) {
                            console.log(response);
                            var button = $("input[value='" + userID + "']").siblings(".toggleButton");
                            button.toggleClass("btn-success btn-danger");
                            var buttonIcon = button.hasClass("btn-success") ? "<i class='fa fa-user'></i>" : "<i class='fa fa-user-lock'></i>";
                            button.html(buttonIcon);
                        }).fail(function(xhr, status, error) {
                            console.log(error);
                        });
                    }
                });
            });

            //////////////////////////////////////////////////update confirmation/////////////////////////////////////////////
            $(document).ready(function() {
                var dataTable = $('#create-account').DataTable(); // Initialize the DataTable

                $("#editForm").submit(function(event) {
                    event.preventDefault();
                    var userID = $(this).find("input[name='userID']").val();

                    // Show confirmation dialog
                    if (confirm("Are you sure you want to update the user's information?")) {
                        $.post('php/update.php', $("#editForm").serialize())
                            .done(function(response) {
                                console.log("Update success");
                                window.location.href = "http://iot.comteq.edu.ph/iot/ui.php";
                            })
                            .fail(function(xhr, status, error) {
                                console.log(error);
                                // Handle AJAX request failure here
                            });
                    }
                });

            });
            ///////////////////////////////////////////fetch who edit//////////////////////////////////////////////////////////////////

            function getDataFromDatabase(userID) {
                console.log("Button ID:", "editBtn-" + userID);

                fetch("php/edit.php?userID=" + userID)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById("userID").value = userID;
                        document.getElementById("fullnameEdit").value = data.FullName;
                        document.getElementById("usernameEdit").value = data.Username;
                        document.getElementById("userRoleEdit").value = data.UserRole;

                    })
                    .catch(error => console.error(error));
            }
            // Get the input field element
            var inputField = document.getElementById('tryEdit');
            // Add click event listener to clear the input field
            inputField.addEventListener('click', function() {
                inputField.value = ''; // Reset the value to empty
            });
            ///////////////////////////////////////////////////////////////////////////////////
            function Edituser(EdituserID) {
                console.log(EdituserID);
            }
        </script>
    </body>

    </html>
<?php
    // Add JavaScript code to handle the automatic logout
    echo '<script>
        let remainingTime = 1800;
        let countdownTimer = setInterval(() => {
            //console.log("Timer:", remainingTime);
            remainingTime--;
            if (remainingTime === 0) {
                clearInterval(countdownTimer);
                console.log("Timer expired");
                $.post("http://iot.comteq.edu.ph/iot/logout.php", () => {
                    window.location.replace("login.php");
                });
            }
        }, 1000);

        console.log("Timer started");
        </script>';

    mysqli_close($conn);
} else {

    header("Location: login.php");
    exit();
}
?>