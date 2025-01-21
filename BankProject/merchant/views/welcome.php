<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit;
}

include_once('../model/db.php');
$db = new myDB();
$connection = $db->openCon();

// Get the logged-in user's email from the session
$user_email = $_SESSION['loggedin_user']['email'];

// Fetch the user's data from the database based on their email
$sql = "SELECT * FROM merchant WHERE Email = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch the user's data from the database
    $user_data = $result->fetch_assoc();
} else {
    // If no data is found, handle the case
    $user_data = null;
}

$stmt->close();
$db->closeCon($connection);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchant Dashboard</title>
    <link rel="stylesheet" href="../css/mystyle.css">
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($user_data['Name']); ?>!</h1>

    <h2>Your Account Information</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Merchant ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Business Name</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($user_data): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user_data['MerchantId']); ?></td>
                    <td><?php echo htmlspecialchars($user_data['Name']); ?></td>
                    <td><?php echo htmlspecialchars($user_data['Email']); ?></td>
                    <td><?php echo htmlspecialchars($user_data['Password']); ?></td>
                    <td><?php echo htmlspecialchars($user_data['BusinessName']); ?></td>
                </tr>
            <?php else: ?>
                <tr>
                    <td colspan="5">No data available</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <br>
    <a href="../views/update.php">Update</a>
</body>
</html>
