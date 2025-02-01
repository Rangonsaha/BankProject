<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Bank Management System</title>
    <link rel="stylesheet" href="../css/mystyle.css">
</head>
<body>
    <form method="POST" action="../control/forgot_password_control.php">
        <table align="center">
            <tr>
                <td>
                    <div>
                        <fieldset>
                            <legend>Forgot Password</legend>

                            <label for="email">Enter your Email:</label>
                            <input type="email" name="email" id="email" required><br><br>

                            <input type="submit" class="submitbutton" value="Reset Password"><br><br>

                            <p><a href="login.php">Back to Login</a></p>
                        </fieldset>
                    </div>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
