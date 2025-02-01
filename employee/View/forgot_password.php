<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../CSS/mystyle.css"> <!-- Your custom styles -->
    <script src="../JS/forgot_password.js"></script> <!-- Link to the JS file -->
</head>
<body>

<?php include 'header.php'; ?>

<center>
    <h2>Forgot Password</h2>

    <?php
    session_start();
    if (isset($_SESSION['error_message'])) {
        echo '<div>' . $_SESSION['error_message'] . '</div>';
        unset($_SESSION['error_message']);
    }
    if (isset($_SESSION['message'])) {
        echo '<div>' . $_SESSION['message'] . '</div>';
        unset($_SESSION['message']);
    }
    ?>

    <!-- Forgot Password Form with validation -->
    <form id="forgotPasswordForm" action="forgot_password_control.php" method="post" onsubmit="return validateForgotPasswordForm()">
        <fieldset>
            <center>
                <legend><strong>Enter Your Email</strong></legend>
            </center>
            <br>
            <table class="m">
                <tr>
                    <td class="black"><label for="email">Email:</label></td>
                    <td><input type="email" id="email" name="email" placeholder="Your email" ></td>
                </tr>
            </table>
            <!-- Error message will be shown here if validation fails -->
            <div id="error-message" ></div>
            <button type="submit"><strong>Submit</strong></button>
        </fieldset>
    </form>

    
    <p class="black">Don't have an account? <a href="Employee_signup.php">Sign up here</a></p>

</center>

<?php include 'footer.php'; ?>

</body>
</html>