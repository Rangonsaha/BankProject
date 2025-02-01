<?php
session_start(); 


if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

require_once '../model/db.php'; 


$db = new myDB();
$transactions = $db->getTransactions(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/mystyle.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Management</title>
</head>
<body>
<?php include 'header.php'; ?>
    <div class="container">
        <h1>Transaction Management</h1>

       
        <?php if (isset($_SESSION['success'])): ?>
            <p class="success-message"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
        <?php elseif (isset($_SESSION['error'])): ?>
            <p class="error-message"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
        <?php endif; ?>

        <h2>All Transactions</h2>
        <?php if ($transactions && $transactions->num_rows > 0): ?>
            <table class="transaction-table">
                <tr>
                    <th>Transaction ID</th>
                    <th>Account ID</th>
                    <th>Amount</th>
                    <th>Transaction Type</th>
                    <th>Date</th>
                    <th>Initiated By</th>
                    <th>Action</th>
                </tr>
                <?php while ($row = $transactions->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['TransactionId']; ?></td>
                        <td><?php echo $row['AccountId']; ?></td>
                        <td><?php echo $row['Amount']; ?></td>
                        <td><?php echo $row['TransactionType']; ?></td>
                        <td><?php echo $row['Date']; ?></td>
                        <td><?php echo $row['InitiatedBy']; ?></td>
                        <td>
                           
                            <a href="transaction_update.php?id=<?php echo $row['TransactionId']; ?>" class="user-table">Update</a> |
                            <a href="../control/transaction_view_control.php?action=delete&id=<?php echo $row['TransactionId']; ?>" class="user-table" onclick="return confirm('Are you sure you want to delete this transaction?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No transactions found.</p>
        <?php endif; ?>

       
        <h2>Add New Transaction</h2>
        <form action="../control/transaction_view_control.php" method="POST">
            <label for="accountId">Account ID:</label>
            <input type="text" name="accountId" class="form-input">
            <label for="amount">Amount:</label>
            <input type="number" name="amount" class="form-input" step="0.01">
            <label for="transactionType">Transaction Type:</label>
            <select name="transactionType" class="form-input">
                <option value="Cash">Cash</option>
                <option value="Transfer">Transfer</option>
            </select>
            <label for="date">Date:</label>
            <input type="date" name="date" class="form-input">
            <label for="initiatedBy">Initiated By:</label>
            <input type="text" name="initiatedBy" class="form-input">
            <button type="submit" name="action" value="add" class="btnSubmit">Add Transaction</button>
        </form>

       
        <div class="add_new_message">
            <a href="transaction_view.php">Refresh to view latest transactions</a>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
