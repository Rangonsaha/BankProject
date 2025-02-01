<?php

// Database connection function
function connectDB()
{
    $host = 'localhost'; // Replace with your database host
    $user = 'root'; // Replace with your MySQL username
    $password = ''; // Replace with your MySQL password
    $database = 'bankmanagementsystem'; // Replace with your database name

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}

// Add a new user to the database
function addCustomer($customer)
{
    try {
        $conn = connectDB();

        // Do not hash the password, store it as is
        $sql = "INSERT INTO customer (Email, Name, Password, Phone) VALUES (:Email, :Name, :Password, :Phone)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':Email', $customer['Email']);
        $stmt->bindParam(':Name', $customer['Name']);
        $stmt->bindParam(':Password', $customer['Password']);  // Store plain password
        $stmt->bindParam(':Phone', $customer['Phone']);

        return $stmt->execute();
    } catch (PDOException $e) {
        echo "<p style='color:red;'>Database error: " . $e->getMessage() . "</p>";
        return false;
    }
}

// Function to fetch user bank account balance based on CustomerId
function getSenderAccountBalance($customerId)
{
    try {
        $conn = connectDB();
        $sql = "SELECT * FROM bankaccount WHERE CustomerId = :customerId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':customerId', $customerId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<p style='color:red;'>Error fetching sender account: " . $e->getMessage() . "</p>";
        return false;
    }
}

// Function to fetch receiver's bank account details
function getReceiverAccount($accountId)
{
    try {
        $conn = connectDB();
        $sql = "SELECT * FROM bankaccount WHERE AccountId = :accountId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':accountId', $accountId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<p style='color:red;'>Error fetching receiver account: " . $e->getMessage() . "</p>";
        return false;
    }
}

// Function to update sender's account balance
function updateSenderBalance($accountId, $newBalance)
{
    try {
        $conn = connectDB();
        $sql = "UPDATE bankaccount SET Balance = :newBalance WHERE AccountId = :accountId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':newBalance', $newBalance);
        $stmt->bindParam(':accountId', $accountId);
        return $stmt->execute();
    } catch (PDOException $e) {
        echo "<p style='color:red;'>Error updating sender balance: " . $e->getMessage() . "</p>";
        return false;
    }
}

// Function to update receiver's account balance
function updateReceiverBalance($accountId, $newBalance)
{
    try {
        $conn = connectDB();
        $sql = "UPDATE bankaccount SET Balance = :newBalance WHERE AccountId = :accountId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':newBalance', $newBalance);
        $stmt->bindParam(':accountId', $accountId);
        return $stmt->execute();
    } catch (PDOException $e) {
        echo "<p style='color:red;'>Error updating receiver balance: " . $e->getMessage() . "</p>";
        return false;
    }
}

// Function to record the transaction
function recordTransaction($accountId, $amount, $initiatedBy)
{
    try {
        $conn = connectDB();
        $sql = "INSERT INTO transaction (AccountId, Amount, Date, InitiatedBy) VALUES (:accountId, :amount, NOW(), :initiatedBy)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':accountId', $accountId);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':initiatedBy', $initiatedBy);
        return $stmt->execute();
    } catch (PDOException $e) {
        echo "<p style='color:red;'>Error recording transaction: " . $e->getMessage() . "</p>";
        return false;
    }
}

// Function to insert feedback into the database
function insertFeedback($pdo, $customer_id, $rating, $message)
{
    // Check if the CustomerId exists in the customer table
    $checkQuery = "SELECT COUNT(*) FROM customer WHERE CustomerId = :customer_id";
    $stmt = $pdo->prepare($checkQuery);
    $stmt->bindParam(':customer_id', $customer_id);
    $stmt->execute();
    $result = $stmt->fetchColumn();

    // If the CustomerId does not exist, return false
    if ($result == 0) {
        echo "Error: Customer ID does not exist.";
        return false;
    }

    // If the CustomerId exists, insert the feedback
    $query = "INSERT INTO feedback (CustomerId, Rating, Message) VALUES (:customer_id, :rating, :message)";
    $stmt = $pdo->prepare($query);
    
    $stmt->bindParam(':customer_id', $customer_id);
    $stmt->bindParam(':rating', $rating);
    $stmt->bindParam(':message', $message);
    
    return $stmt->execute();
}

?>
