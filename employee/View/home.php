<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

include '../Model/db.php';

// Get the logged-in user's email from session
$email = $_SESSION['loggedin_user']['email'];

// Create a database connection
$db = new myDB();
$connection = $db->openCon();

// Query to get user data from the employee table
$sql = "SELECT * FROM employee WHERE Email = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if the user exists
if ($result->num_rows > 0) {
    // Fetch the user data
    $user_data = $result->fetch_assoc();
} else {
    echo "No data found for the logged-in user.";
    exit;
}

$stmt->close();
$db->closeCon($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>

    <center>
        <h2>Welcome, <?php echo htmlspecialchars($user_data['Name']); ?></h2>
        <p>You are logged in successfully!</p>

        <h3>Your Details:</h3>
        <table border="1" >
            <tr>
                <th>Name</th>
                <td><?php echo htmlspecialchars($user_data['Name']); ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo htmlspecialchars($user_data['Email']); ?></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><?php echo htmlspecialchars($user_data['Password']); ?></td>
            </tr>
            <tr>
                <th>Gender</th>
                <td><?php echo htmlspecialchars($user_data['Gender']); ?></td>
            </tr>
        </table>

        <br>
        <form action="delete_user.php" method="post">
            <input type="hidden" name="email" value="<?php echo $user_data['Email']; ?>">
            <button type="submit">Delete Account</button>
        </form>

    </center>

</body>
</html>
