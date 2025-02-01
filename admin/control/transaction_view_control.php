<?php
session_start(); 
require_once '../model/db.php'; 

$db = new myDB();


if ($_SERVER['REQUEST_METHOD'] === 'POST' || isset($_GET['action'])) {
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        // Add transaction
        $accountId = $_POST['accountId'];
        $amount = $_POST['amount'];
        $transactionType = $_POST['transactionType'];
        $date = $_POST['date'];
        $initiatedBy = $_POST['initiatedBy'];

        $result = $db->insertTransaction($accountId, $amount, $transactionType, $date, $initiatedBy);
        if ($result === true) {
            $_SESSION['success'] = "Transaction added successfully.";
        } else {
            $_SESSION['error'] = "Failed to add transaction: " . $result;
        }
        header("Location: ../view/transaction_view.php");
        exit();

    } elseif (isset($_GET['action']) && $_GET['action'] === 'delete') {
       
        $transactionId = $_GET['id'];
        $connection = $db->openCon();
        $stmt = $connection->prepare("DELETE FROM transaction WHERE TransactionId = ?");
        $stmt->bind_param("i", $transactionId);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Transaction deleted successfully.";
        } else {
            $_SESSION['error'] = "Failed to delete transaction.";
        }
        $stmt->close();
        $db->closeCon($connection);
        header("Location: ../view/transaction_view.php");
        exit();

    } elseif (isset($_GET['action']) && $_GET['action'] === 'update') {
        // Update transaction logic can be added here (e.g., redirect to update page)
        $_SESSION['error'] = "Update functionality not implemented yet.";
        header("Location: ../view/transaction_view.php");
        exit();
    }
} else {
    header("Location: ../view/transaction_view.php");
    exit();
}
?>
