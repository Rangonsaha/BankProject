<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="../css/transaction.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="transaction-container">
    <h2>Make a Transaction</h2>
    <form action="../control/transactionControl.php" method="POST" class="transaction-form">
        <div class="form-group">
            <label for="accountId">Account ID:</label>
            <input type="number" id="accountId" name="accountId" placeholder="Enter Account ID" required>
        </div>
        <div class="form-group">
            <label for="transactionType">Transaction Type:</label>
            <select id="transactionType" name="transactionType" required>
                <option value="">Select Transaction Type</option>
                <option value="Credit">Credit</option>
                <option value="Debit">Debit</option>
            </select>
        </div>
        <div class="form-group">
            <label for="amount">Amount:</label>
            <input type="number" id="amount" name="amount" placeholder="Enter Amount" min="1" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="initiatedBy">Initiated By:</label>
            <input type="text" id="initiatedBy" name="initiatedBy" placeholder="Your Name" required>
        </div>
        <button type="submit" class="submit-btn">Submit Transaction</button>
    </form>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
