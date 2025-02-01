<?php
// Start the session at the very beginning of the file
session_start();

// Check if the session variable 'CustomerId' is set
if (!isset($_SESSION['CustomerId'])) {
    // Handle the case when the customer is not logged in
    echo "You must be logged in to request a loan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Request</title>
    <link rel="stylesheet" href="../css/loan.css"> <!-- Linking to the external CSS -->
</head>
<body>

<?php include 'header.php'; ?>

    <div class="container">
        <h2 class="page-title">Request a Loan</h2>
        
        <form action="../control/loanControl.php" method="POST" class="loan-form">
            <div class="form-group">
                <label for="CustomerId">Customer ID:</label>
                <input type="text" name="CustomerId" id="CustomerId" value="<?php echo $_SESSION['CustomerId']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="Amount">Loan Amount:</label>
                <input type="number" name="Amount" id="Amount" required placeholder="Enter loan amount">
            </div>
            <div class="form-group">
                <label for="LoanTerm">Loan Term (Months):</label>
                <input type="number" name="LoanTerm" id="LoanTerm" required placeholder="Enter loan term in months">
            </div>
            <button type="submit" class="submit-btn">Submit Request</button>
        </form>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
