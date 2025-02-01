<?php
session_start();


if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

require_once '../model/db.php'; 


$transactionId = isset($_GET['id']) ? $_GET['id'] : '';

if ($transactionId) {
    $db = new myDB();
    $connection = $db->openCon();

  
    $stmt = $connection->prepare("SELECT * FROM transaction WHERE TransactionId = ?");
    $stmt->bind_param("i", $transactionId);
    $stmt->execute();
    $result = $stmt->get_result();
    $transactionData = $result->fetch_assoc();

   
    $stmt->close();
    $db->closeCon($connection);

    if (!$transactionData) {
        header("Location: welcome.php");
        exit();
    }
} else {
    header("Location: welcome.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/mystyle.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Transaction</title>
</head>
<body>
<?php include 'header.php'; ?>
    <div class="container">
        <h1>Update Transaction</h1>

       
        <?php if (isset($_SESSION['success'])): ?>
            <p class="success-message"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
        <?php elseif (isset($_SESSION['error'])): ?>
            <p class="error-message"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
        <?php endif; ?>

       
        <form action="../control/transaction_update_control.php" method="POST">
            <input type="hidden" name="transaction_id" value="<?php echo $transactionData['TransactionId']; ?>">

            <div class="form-group">
                <label for="accountId">Account ID:</label>
                <input type="text" name="accountId" value="<?php echo $transactionData['AccountId']; ?>" required>
            </div>

            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" name="amount" step="0.01" value="<?php echo $transactionData['Amount']; ?>" required>
            </div>

            <div class="form-group">
                <label for="transactionType">Transaction Type:</label>
                <select name="transactionType" required>
                    <option value="Cash" <?php echo ($transactionData['TransactionType'] === 'Cash') ? 'selected' : ''; ?>>Cash</option>
                    <option value="Transfer" <?php echo ($transactionData['TransactionType'] === 'Transfer') ? 'selected' : ''; ?>>Transfer</option>
                </select>
            </div>

            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" name="date" value="<?php echo $transactionData['Date']; ?>" required>
            </div>

            <div class="form-group">
                <label for="initiatedBy">Initiated By:</label>
                <input type="text" name="initiatedBy" value="<?php echo $transactionData['InitiatedBy']; ?>" required>
            </div>

            <button type="submit" name="action" value="update">Update Transaction</button>
        </form>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
