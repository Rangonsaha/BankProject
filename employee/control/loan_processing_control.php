<?php
session_start();
include '../Model/db.php';

// Check if employee is logged in
if (!isset($_SESSION['employee_logged_in'])) {
    header("Location: login.php");
    exit();
}

$db = new myDB();
$conn = $db->openCon();

// Handle form submissions for loan processing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Apply for loan
    if (isset($_POST['apply_loan'])) {
        $customer_id = $_POST['customer_id'];
        $loan_amount = $_POST['loan_amount'];
        $loan_term = $_POST['loan_term'];
        $loan_type = $_POST['loan_type'];

        // Validate inputs
        if (empty($customer_id) || !is_numeric($customer_id) || $customer_id <= 0) {
            echo "<p>Invalid Customer ID.</p>";
        } elseif (empty($loan_amount) || !is_numeric($loan_amount) || $loan_amount <= 0) {
            echo "<p>Loan amount must be a positive number.</p>";
        } elseif (empty($loan_term) || !is_numeric($loan_term) || $loan_term <= 0) {
            echo "<p>Loan term must be a positive number.</p>";
        } elseif (empty($loan_type)) {
            echo "<p>Please select a loan type.</p>";
        } else {
            // Call applyForLoan method from db.php
            $message = $db->applyForLoan($customer_id, $loan_amount, $loan_term, $loan_type, $conn);
            echo $message;
        }
    }

    // Approve loan
    if (isset($_POST['approve_loan'])) {
        $loan_id = $_POST['loan_id'];

        // Validate loan ID
        if (empty($loan_id) || !is_numeric($loan_id) || $loan_id <= 0) {
            echo "<p>Invalid Loan ID.</p>";
        } else {
            // Call approveLoan method from db.php
            $message = $db->approveLoan($loan_id, $conn);
            echo $message;
        }
    }

    // Reject loan
    if (isset($_POST['reject_loan'])) {
        $loan_id = $_POST['loan_id'];

        // Validate loan ID
        if (empty($loan_id) || !is_numeric($loan_id) || $loan_id <= 0) {
            echo "<p>Invalid Loan ID.</p>";
        } else {
            // Call rejectLoan method from db.php
            $message = $db->rejectLoan($loan_id, $conn);
            echo $message;
        }
    }
}

$db->closeCon($conn);
?>
