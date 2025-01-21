<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/mystyle.css">
</head>
<body>
    <form action="../control/login_control.php" method="post">
        <center>
            <fieldset>
                <p>Customer Login</p>
                <table>
                    <tr>
                        <td><label for="email">Email:</label></td>
                        <td><input type="text" name="email" placeholder="Enter your email" required></td>
                    </tr>
                    <tr>
                        <td><label for="password">Password:</label></td>
                        <td><input type="password" name="password" placeholder="Enter your password" required></td>
                    </tr>
                </table>
            </fieldset>
        </center>
        <center>
            <button type="submit" class="button">Login</button>
        </center>
    </form>

    <center>
        <!-- Sign Up Button -->
        <a href="signup.php">
            <button class="button">Sign Up</button>
        </a>
    </center>
</body>
</html>
