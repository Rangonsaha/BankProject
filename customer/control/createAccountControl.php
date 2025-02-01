<?php

require_once '../model/db.php'; // Include the DB connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    
    // Ensure the customer is logged in
    if (!isset($_SESSION['CustomerId'])) {
        echo "<p style='color:red;'>You must be logged in to create a bank account.</p>";
        exit();
    }

    // Get the form data
    $accountType = $_POST['accountType'] ?? '';
    $balance = $_POST['balance'] ?? 0;  // Ensure the balance is provided and default to 0

    // Validate the form data
    if (empty($accountType) || $balance < 0) {
        echo "<p style='color:red;'>Account Type and valid balance are required.</p>";
        exit();
    }

    // Get the customer ID from the session
    $customerId = $_SESSION['CustomerId'];

    // Insert the new account into the bankaccount table
    $conn = connectDB();
    $sql = "INSERT INTO bankaccount (AccountType, Balance, CustomerId, CreatedDate) 
            VALUES (:AccountType, :Balance, :CustomerId, NOW())";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':AccountType', $accountType);
    $stmt->bindParam(':Balance', $balance);
    $stmt->bindParam(':CustomerId', $customerId);

    if ($stmt->execute()) {
        // Redirect to the home page after successfully creating the account
        header("Location: ../view/home.php");
        exit();
    } else {
        // Display an error if account creation failed
        echo "<p style='color:red;'>Failed to create account. Please try again.</p>";
    }
}
