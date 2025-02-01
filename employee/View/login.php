<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Login</title>
    <link rel="stylesheet" href="../CSS/mystyle.css"> 
    
</head>

<body>

<?php include 'header.php'; ?>
<script src="Employee_login_validation.js"></script>


<center>
    <h2>Employee Login</h2>

    <?php
    session_start();
    if (isset($_SESSION['error_message'])) {
        echo '<div class="error-message">' . $_SESSION['error_message'] . '</div>';
        unset($_SESSION['error_message']);
    }
    if (isset($_SESSION['message'])) {
        echo '<div class="success-message">' . $_SESSION['message'] . '</div>';
        unset($_SESSION['message']);
    }
    ?>

    <form action="../control/login_control.php" method="post" onsubmit="validateForm(event)">
        <fieldset>
            <center>
                <legend><strong>Login Information</strong></legend>
            </center>
            <br>
            <table class="m">
                <tr>
                    <td class="black"><label for="email">Email:</label></td>
                    <td><input type="email" id="email" name="email" placeholder="Your email"></td>
                </tr>
                <tr>
                    <td><span id="emailError" ></span></td>
                </tr>
                <tr>
                    <td class="black"><label for="password">Password:</label></td>
                    <td><input type="password" id="password" name="password" placeholder="Your password"></td>
                </tr>
                <tr>
                    <td><span id="passwordError" ></span></td>
                </tr>
            </table>
            
            <button type="submit"><strong>Login</strong></button>
        </fieldset>
    </form>
    <p class="black">Forgot password? <a href="forgot_password.php">Click here!</a></p>
    <p class="black">Don't have an account? <a href="Employee_signup.php">Sign up here</a></p>
</center>

<?php include 'footer.php'; ?>


</body>
</html>
