<?php
session_start();
include_once('../model/db.php');

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../views/login.php'); // Redirect to login page if not logged in
    exit;
}
$db = new myDB();
$connection = $db->openCon();
$result=$db->getUsers( $connection , "merchant");
foreach($result as $row){
$name=$row["Name"];
$BusinessName=$row["BusinessName"];
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT); // Hash the new password
    $business_name = trim($_POST['business_name']);
    $user_email = $_SESSION['loggedin_user']['email']; // Get the logged-in user's email

    // Update the user's data in the database
    $sql = "UPDATE merchant SET Name = ?, Password = ?, BusinessName = ? WHERE Email = ?";
    $stmt = $connection->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssss", $name, $password, $business_name, $user_email);

        if ($stmt->execute()) {
            // Update session data after successful update
            $_SESSION['loggedin_user']['name'] = $name;
            $_SESSION['loggedin_user']['business_name'] = $business_name;

            echo "<p>Data updated successfully!</p>";
            header("Location: ../views/welcome.php"); // Redirect back to the dashboard
            exit;
        } else {
            echo "<p>Error updating data: " . $stmt->error . "</p>";
        }

        $stmt->close();
    } else {
        echo "<p>Error preparing the statement: " . $connection->error . "</p>";
    }

    $db->closeCon($connection);
} else {
    echo "<p>Invalid request method.</p>";
}
?>
