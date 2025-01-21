<?php
session_start(); // Start the session to display session messages
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchant Login - Bank Management System</title>
    <link rel="stylesheet" href="../css/mystyle.css">
</head>
<body>
    <!-- Displaying session messages -->
    <?php if (isset($_SESSION['error_message'])): ?>
        <p style="color: red;"><?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?></p>
    <?php endif; ?>

    <?php if (isset($_SESSION['message'])): ?>
        <p><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></p>
    <?php endif; ?>

    <form method="POST" action="../control/log_control.php">
        <table align="center">
            <tr>
                <td>
                    <div>
                        <fieldset>
                            <legend>Merchant Login</legend>
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" required><br><br>

                            <label for="password">Password:</label>
                            <input type="password" name="password" id="password" required><br><br>

                            <input type="submit" value="Log In">
                        </fieldset>
                    </div>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
