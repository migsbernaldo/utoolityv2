<?php
session_start();
include 'sqlConnection.php';
if (!isset($_SESSION['ID']) && !isset($_SESSION['Username'])) {
    include 'php/headers.php';
    // Retrieve the error message from the session if it exists
    $error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
    unset($_SESSION['error']); // Clear the error message from the session
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="assets/css/login.css">
        <link rel="icon" type="image/x-icon" href="assets/img/utoolity-icon.png">
        <title>uTOOLity Login</title>
    </head>

    <body>
        <div class="container">
            <div class="login">
                <img src="assets/img/utoolity-logo.png" alt="uTOOLity">
                <form method="POST" action="loginVerification.php">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="<?php echo isset($_SESSION['usernameInput']) ? $_SESSION['usernameInput'] : ''; ?>" required>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    <?php if (!empty($error)) { ?>
                        <style>
                            form .error {
                                background: none !important;
                                color: red !important;
                                padding: 0em !important;
                                font-size: 1em;
                            }
                        </style>
                        <p class="error">
                            <?php echo $error; ?>
                        </p>
                    <?php } ?>
                    <input class="loginBtn" type="submit" value="Log In">
                </form>
                <div class="line"></div>
                <p class="text-muted">
                    <strong>uTOOLity</strong> is an innovative IoT device developed as a thesis project by
                    a team of talented 4th year students pursuing a Bachelor of
                    Science in Computer Science at <a id="comteq-link" href="https://lms.comteq.edu.ph">Comteq Computer and Business College</a>.
                    The group of developers behind uTOOLity consists of Clarisse Aratan, Angelo B. Joaquin, Kenneth I. Lopez,
                    John Kenneth Q. Morga, and <a href="https://www.facebook.com/aroweniel">Ronel Rae M. Rafael</a>.
                </p>
            </div>
        </div>
    </body>
    </html>
<?php
    mysqli_close($conn);
} else {
    header("Location: ui.php");
    exit();
}
?>