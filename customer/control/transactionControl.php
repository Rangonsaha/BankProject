<?php
session_start();
require_once '../model/db.php'; // Include database connection functions

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user is logged in
    if (!isset($_SESSION['CustomerId'])) {
        echo "You must be logged in to make a transaction.";
        exit();
    }

    // Get logged-in user's customer ID
    $customerId = $_SESSION['CustomerId'];
    
    // Get input values
    $accountId = $_POST['accountId']; // Target account ID
    $transactionType = $_POST['transactionType']; // Credit or Debit
    $amount = $_POST['amount']; // Transaction amount
    $initiatedBy = $_POST['initiatedBy']; // Name of the person initiating the transaction

    // Validate the transaction
    $conn = connectDB();

    // Fetch the logged-in user's bank account balance
    $senderAccount = getSenderAccountBalance($customerId);

    // Check if the sender account exists
    if (!$senderAccount) {
        echo "Sender account not found.";
        exit();
    }

    // Fetch the target bank account details using the entered AccountId
    $receiverAccount = getReceiverAccount($accountId);

    // Check if the receiver account exists
    if (!$receiverAccount) {
        echo "Receiver account not found.";
        exit();
    }

    // Ensure the sender has sufficient balance for the transaction (for Debit transactions)
    if ($transactionType == 'Debit' && $senderAccount['Balance'] < $amount) {
        echo "Insufficient balance.";
        exit();
    }

    // Begin the transaction
    try {
        // Start a database transaction
        $conn->beginTransaction();

        // Update sender's account balance (Debit)
        if ($transactionType == 'Debit') {
            $newBalance = $senderAccount['Balance'] - $amount;
            if (!updateSenderBalance($senderAccount['AccountId'], $newBalance)) {
                throw new PDOException("Failed to update sender balance.");
            }
        }

        // Update receiver's account balance (Credit)
        if ($transactionType == 'Credit') {
            $newBalance = $receiverAccount['Balance'] + $amount;
            if (!updateReceiverBalance($receiverAccount['AccountId'], $newBalance)) {
                throw new PDOException("Failed to update receiver balance.");
            }
        }

        // Record the transaction in the transaction table
        if (!recordTransaction($accountId, $amount, $initiatedBy)) {
            throw new PDOException("Failed to record the transaction.");
        }

        // Commit the transaction
        $conn->commit();

        header("location: ../view/transactionSuccess.php");
    } catch (PDOException $e) {
        // Rollback if there is an error
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    }
}
?>
