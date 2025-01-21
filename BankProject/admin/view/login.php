<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../css/mystyle.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h1>Login</h1>

        <!-- Login form -->
        <form action="../control/login_control.php" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Login</button>
        </form>

        <!-- Link to registration page -->
        <p>Don't have an account? <a href="signup.php">Register here</a>.</p>
    </div>
</body>
</html>
