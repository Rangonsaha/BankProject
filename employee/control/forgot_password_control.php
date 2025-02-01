<?php
session_start();

require_once('../Model/db.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']); // Get and sanitize the email input

    // Create an instance of the myDB class to connect to the database
    $db = new myDB();
    $conn = $db->openCon();

    // Check if email exists in the database
    if (emailExists($email, $conn)) {
        // Proceed with resetting password (for example, sending reset link)
        $_SESSION['message'] = "Password reset link has been sent to your email address.";
        // You can send an email with a reset link or generate a reset code here.
    } else {
        // If email doesn't exist
        $_SESSION['error_message'] = "This email is not registered.";
    }

    // Close the database connection
    $db->closeCon($conn);

    // Redirect to the forgot password page with messages
    header("Location: ../view/forgot_password.php");
    exit();
}

// Function to check if email already exists
function emailExists($email, $conn) {
    $query = "SELECT * FROM employee WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // If a record is found, return true (email exists)
    return $result->num_rows > 0;
}
?>
