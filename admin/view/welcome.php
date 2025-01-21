<?php
session_start(); // Start the session

// Check if the user is logged in by verifying session data
if (!isset($_SESSION['user'])) {
    header("Location: login.php"); // Redirect to login if user is not logged in
    exit();
}

require '../model/db.php'; // Include the database model

// Create an object of myDB to fetch admin data
$db = new myDB();
$admins = $db->getAdmins(); // Fetch all admins from the database

?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../css/mystyle.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['user']['email']; ?></h1>

    <h2>All Admin Users</h2>
    <?php
    // Check if admins data is available
    if ($admins && $admins->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Admin ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>";

        // Loop through and display all admin users
        while ($row = $admins->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['AdminId'] . "</td>
                    <td>" . $row['Name'] . "</td>
                    <td>" . $row['Email'] . "</td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No admin users found.</p>";
    }
    ?>

    <br><br>
    <a href="login.php">Logout</a> <!-- Logout link -->
</body>
</html>
