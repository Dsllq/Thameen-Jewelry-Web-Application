<?php
session_start();
require_once('../include/connection.php');

// Reset error message when the page is refreshed
unset($_SESSION['error']);

$iserror = false; // Variable to indicate if there's an error
$error = ''; // Store error message

if (isset($_POST['login']) && $_SERVER['REQUEST_METHOD'] == 'POST') { // Ensure the form is submitted using POST
    $uname = $_POST['username'];
    $password = $_POST['password'];
    $captcha_input = $_POST['captcha']; // Added captcha input field

    // Query admin table
    $admin_sql = "SELECT * FROM `admin` WHERE `username` = '$uname' AND `password` = '$password'";
    $admin_result = mysqli_query($conn, $admin_sql);
    $admin_row = mysqli_fetch_assoc($admin_result);

    if ($admin_row && $captcha_input == $_SESSION['captcha']) { // Added captcha validation condition
        $_SESSION['password'] = $admin_row['password'];
        $_SESSION['username'] = $admin_row['username'];

        if ($admin_row['is_admin'] == 1) { // Check if user is an admin
            header('Location: ../adminPages/manageProduct-page.php');
            exit(); // Always exit after redirecting
        } else {
            header('Location: ../adminPages/manageProduct-page.php'); // Redirect to the admin dashboard
            exit();
        }
    } else {
        $iserror = true;
        $error = 'Invalid username, password, or captcha'; // Update error message to include captcha
        $_SESSION['error'] = $error; // Store error message in session
    }
}

// Captcha generation logic
$captcha = ""; // Initialize captcha variable
$characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"; // Characters for captcha
for ($i = 0; $i < 5; $i++) { // Generate 5-character captcha
    $captcha .= $characters[rand(0, strlen($characters) - 1)];
}
$_SESSION['captcha'] = $captcha; // Store captcha in session
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login-style.css">
    <?php include("../include/fonts.html"); ?>
</head>

<body>
    <?php
    session_start(); // Start session at the beginning
    require_once('../include/header.php');

    // Reset error message when the page is refreshed
    unset($_SESSION['error']);

    // Captcha generation logic
    $captcha = ""; // Initialize captcha variable
    $characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"; // Characters for captcha
    for ($i = 0; $i < 5; $i++) { // Generate 5-character captcha
        $captcha .= $characters[rand(0, strlen($characters) - 1)];
    }
    $_SESSION['captcha'] = $captcha; // Store captcha in session
    ?>
    <div class="login-container">
        <form action="" method="POST">
            <h2>Login</h2>
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter Your Username" required autofocus>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter Your Password" required>
            </div>
            <div class="input-group"> <!-- Add captcha input field -->
                <label for="captcha">Captcha</label>
                <input type="text" id="captcha" name="captcha" placeholder="Enter Captcha" required>
            </div>
            <div class="captcha-container"> <!-- Captcha display area -->
                <div class="captcha-display" id="captcha-display"><?php echo $captcha; ?></div>
            </div>
            <input type="submit" class='btn' value='Login' name='login'>
            <!-- Error message display -->
            <?php if ($iserror || isset($_SESSION['error'])) : ?>
                <p class="error-message"><?php echo htmlspecialchars($error ?? $_SESSION['error']); ?></p>
            <?php endif; ?>
        </form>
    </div>

    </div>
    <?php include('../include/footer.php'); ?>
</body>

</html>