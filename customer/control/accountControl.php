<?php
session_start();
require_once '../model/db.php';

// Ensure the customer is logged in
if (!isset($_SESSION['CustomerId'])) {
    header("Location: ../view/login.php"); // Redirect to login page if not logged in
    exit();
}

// Get customer details
$customerId = $_SESSION['CustomerId'];
$conn = connectDB();

// Fetch customer details
$sqlCustomer = "SELECT * FROM customer WHERE CustomerId = :CustomerId";
$stmtCustomer = $conn->prepare($sqlCustomer);
$stmtCustomer->bindParam(':CustomerId', $customerId);
$stmtCustomer->execute();
$customer = $stmtCustomer->fetch(PDO::FETCH_ASSOC);

// Fetch bank account details for the customer
$sqlAccount = "SELECT * FROM bankaccount WHERE CustomerId = :CustomerId LIMIT 1";
$stmtAccount = $conn->prepare($sqlAccount);
$stmtAccount->bindParam(':CustomerId', $customerId);
$stmtAccount->execute();
$account = $stmtAccount->fetch(PDO::FETCH_ASSOC);

// If no account found, prompt user to create one
if (!$account) {
    header("Location: ../view/createAccount.php");
    exit();
}

?>