<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bank Management System</title>
    <link rel="stylesheet" href="../css/mystyle.css">
</head>
<body>
    <form id="login-form" method="POST" action="../control/log_control.php">
        <table align="center">
            <tr>
                <td>
                    <div>
                        <fieldset>
                            <legend>Merchant Login</legend>

                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email">
                            <div id="email-error"></div><br><br>

                            <label for="password">Password:</label>
                            <input type="password" name="password" id="password">
                            <div id="password-error"></div><br><br>

                            <input type="submit" class="loginbutton" value="Login"><br><br>

                            <!-- Links for Sign Up and Forgot Password -->
                            <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
                            <p><a href="forgot_password.php">Forgot Password?</a></p>
                        </fieldset>
                    </div>
                </td>
            </tr>
        </table>
    </form>

    <script src="../js/login_validation.js"></script>
</body>
</html>
