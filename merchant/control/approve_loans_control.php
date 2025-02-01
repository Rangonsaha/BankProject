<?php
session_start();

// Include the database connection and functions
require_once('../model/db.php');

// Ensure the merchant is logged in
if (!isset($_SESSION['merchant_id'])) {
    echo "Error: Merchant not logged in.";
    exit;
}

// Fetch all pending loans
$pendingLoans = getPendingLoans();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $loanId = $_POST['loanId'];
    $customerId = $_POST['customerId'];
    $loanAmount = $_POST['loanAmount'];
    $interestRate = isset($_POST['interest_rate']) ? floatval($_POST['interest_rate']) : 0; // Get the interest rate

    if (isset($_POST['approve'])) {
        // Approve the loan
        $loanApproved = approveLoan($loanId);

        // If loan is approved, update the bank account balance based on the interest rate
        if ($loanApproved) {
            // Calculate loan amount including interest
            $loanAmountWithInterest = $loanAmount - ($loanAmount * ($interestRate / 100));

            // Update the customer's bank account balance
            $balanceUpdated = updateBankAccountBalance($customerId, $loanAmountWithInterest);

            if ($balanceUpdated) {
                $_SESSION['success_message'] = "Loan approved and balance updated successfully!";
            } else {
                $_SESSION['error_message'] = "Error updating bank account balance.";
            }
        } else {
            $_SESSION['error_message'] = "Error approving loan.";
        }
    } elseif (isset($_POST['decline'])) {
        // Decline the loan
        $loanDeclined = declineLoan($loanId);

        if ($loanDeclined) {
            $_SESSION['success_message'] = "Loan declined successfully!";
        } else {
            $_SESSION['error_message'] = "Error declining loan.";
        }
    }
}

// Redirect to the view page after processing
header('Location: ../views/approve_loans.php');
exit;
?>
