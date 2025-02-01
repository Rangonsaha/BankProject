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

// Display success or error messages
if (isset($_SESSION['success_message'])) {
    echo "<p style='color: green;'>" . $_SESSION['success_message'] . "</p>";
    unset($_SESSION['success_message']);
}

if (isset($_SESSION['error_message'])) {
    echo "<p style='color: red;'>" . $_SESSION['error_message'] . "</p>";
    unset($_SESSION['error_message']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve Loans</title>
    <link rel="stylesheet" href="../css/approve_loans.css">
</head>
<body>

    <?php include('header.php'); ?>

    <div class="approve-loans-container">
        <h2>Approve Pending Loans</h2>

        <?php if (count($pendingLoans) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Loan ID</th>
                        <th>Customer ID</th>
                        <th>Amount</th>
                        <th>Interest Rate (%)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pendingLoans as $loan): ?>
                        <tr>
                            <td><?php echo $loan['LoanId']; ?></td>
                            <td><?php echo $loan['CustomerId']; ?></td>
                            <td><?php echo number_format($loan['Amount'], 2); ?></td>
                            <td>
                                <form action="../control/approve_loans_control.php" method="POST">
                                    <input type="hidden" name="loanId" value="<?php echo $loan['LoanId']; ?>">
                                    <input type="hidden" name="customerId" value="<?php echo $loan['CustomerId']; ?>">
                                    <input type="hidden" name="loanAmount" value="<?php echo $loan['Amount']; ?>">

                                    <!-- Interest Rate Field -->
                                    <input type="number" name="interest_rate" step="0.01" placeholder="Interest Rate (%)">
                                    <br><br>

                                    <!-- Approve and Decline Buttons -->
                                    <button type="submit" name="approve" class="btn">Approve Loan</button>
                                    <button type="submit" name="decline" class="btn">Decline Loan</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No pending loans to approve.</p>
        <?php endif; ?>

    </div>

    <?php include('footer.php'); ?>

</body>
</html>
