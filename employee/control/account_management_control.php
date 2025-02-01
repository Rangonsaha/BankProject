<?php
session_start();
include '../Model/db.php';

// Check if employee is logged in
if (!isset($_SESSION['employee_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Initialize database connection
$db = new myDB();
$conn = $db->openCon();

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = '';

    if (isset($_POST['open_account'])) {
        $customer_name = trim($_POST['customer_name']);
        $customer_email = trim($_POST['customer_email']);
        $account_type = trim($_POST['account_type']);

        if (empty($customer_name) || empty($customer_email) || empty($account_type)) {
            $message = "All fields are required.";
        } elseif (!filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
            $message = "Invalid email format.";
        } else {
            $message = $db->openAccount($customer_name, $customer_email, $account_type, $conn);
        }
    }

    if (isset($_POST['close_account'])) {
        $account_id = trim($_POST['account_id']);

        if (empty($account_id) || !is_numeric($account_id)) {
            $message = "A valid account ID is required.";
        } else {
            $message = $db->closeAccount($account_id, $conn);
        }
    }

    if (isset($_POST['update_account'])) {
        $account_id = trim($_POST['account_id']);
        $new_account_type = trim($_POST['new_account_type']);

        if (empty($account_id) || !is_numeric($account_id) || empty($new_account_type)) {
            $message = "Valid account ID and account type are required.";
        } else {
            $message = $db->updateAccountType($account_id, $new_account_type, $conn);
        }
    }

    // Store message in session and redirect
    $_SESSION['message'] = $message;
    header("Location: ../View/account_management.php");
    exit();
}

// Close connection
$db->closeCon($conn);
?>
