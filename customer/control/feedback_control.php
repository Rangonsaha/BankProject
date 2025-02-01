<?php
session_start();  // Make sure the session is started

// Include the DB connection and functions
require_once('../model/db.php');  

// Check if the CustomerId is set in the session (this assumes the login process has already set it)
if (!isset($_SESSION['CustomerId']) || empty($_SESSION['CustomerId'])) {
    echo "<p style='color:red;'>You need to log in first.</p>";
    exit();
}

// Check if the form has been submitted
if (isset($_POST['submit_feedback'])) {
    // Retrieve the form data
    $customerId = $_SESSION['CustomerId'];  // Use the session's CustomerId
    $rating = $_POST['rating'];
    $message = $_POST['message'];

    // Get the PDO connection
    $pdo = connectDB();

    // Insert the feedback into the database using the insertFeedback function
    $success = insertFeedback($pdo, $customerId, $rating, $message);

    // Check if the feedback was successfully inserted
    if ($success) {
        echo "Feedback submitted successfully!";
        header("Location: ../view/feedback.php");

    } else {
        echo "There was an error submitting your feedback.";
    }
}
?>
