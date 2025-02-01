<?php
session_start(); 
require_once '../model/db.php'; 

$db = new myDB();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'update') {
       
        $transactionId = $_POST['transaction_id'];
        $accountId = $_POST['accountId'];
        $amount = $_POST['amount'];
        $transactionType = $_POST['transactionType'];
        $date = $_POST['date'];
        $initiatedBy = $_POST['initiatedBy'];

        
        $connection = $db->openCon();
        $stmt = $connection->prepare("UPDATE transaction SET AccountId = ?, Amount = ?, TransactionType = ?, Date = ?, InitiatedBy = ? WHERE TransactionId = ?");
        $stmt->bind_param("sssssi", $accountId, $amount, $transactionType, $date, $initiatedBy, $transactionId);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Transaction updated successfully.";
        } else {
            $_SESSION['error'] = "Failed to update transaction.";
        }

        $stmt->close();
        $db->closeCon($connection);

        
        header("Location: ../view/transaction_view.php");
        exit();
    }
} else {
    header("Location: ../view/transaction_view.php");
    exit();
}
?>
