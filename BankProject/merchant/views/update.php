<?php
include '../control/update_control.php';


// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit;
}

// Get the logged-in user's current data from the session
$user_data = $_SESSION['loggedin_user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Account Information</title>
    <link rel="stylesheet" href="../css/mystyle.css">
</head>
<body>
    <h1>Update Your Account Information</h1>
    
    <form method="POST" action="../control/update_control.php">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" required><br><br>

        <label for="password">New Password:</label><br>
        <input type="password" id="password" name="password" placeholder="Enter new password" required><br><br>

        <label for="business_name">Business Name:</label><br>
        <input type="text" id="business_name" name="business_name" value="<?php echo $BusinessName; ?>" required><br><br>

        <button type="submit">Update</button>
    </form>

    <br>
    <a href="../views/welcome.php">Back to Dashboard</a>
</body>
</html>
