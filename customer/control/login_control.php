<?php

require_once '../model/db.php'; // Include the DB connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        echo "<p style='color:red;'>Email and password are required.</p>";
        exit();
    }

    // Query the database to get the user data based on the email
    $conn = connectDB();
    $sql = "SELECT * FROM customer WHERE Email = :Email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':Email', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the user exists and the password matches
    if ($user && $user['password'] === $password) {  // Use lowercase 'password' here
        // Successful login
        session_start();
        $_SESSION['CustomerId'] = $user['CustomerId'];
        $_SESSION['Name'] = $user['Name'];


        // Check if the user already has a bank account
        $customerId = $user['CustomerId'];
        $accountSql = "SELECT * FROM bankaccount WHERE CustomerId = :CustomerId";
        $accountStmt = $conn->prepare($accountSql);
        $accountStmt->bindParam(':CustomerId', $customerId);
        $accountStmt->execute();

        // If bank account exists, redirect to home.php, otherwise to createAccount.php
        if ($accountStmt->rowCount() > 0) {
            // Bank account exists
            header("Location: ../view/home.php");
            exit();
        } else {
            // Bank account does not exist
            header("Location: ../view/createAccount.php");
            exit();
        }
    } else {
        // Invalid email or password
        echo "<p style='color:red;'>Invalid email or password.</p>";
    }
}
