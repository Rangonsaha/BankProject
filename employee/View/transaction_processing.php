<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Processing</title>
    <link rel="stylesheet" href="../CSS/mystyle.css">
    <link rel="stylesheet" href="../CSS/transaction_processing.css">

</head>
<body>

<?php include 'header.php'; ?>

<center>
    <h2>Transaction Processing</h2>

    <!-- Deposit Form -->
    <form method="POST" action="../control/transaction_processing_control.php">
        <h3>Deposit Money</h3>
        <input type="number" name="account_id" placeholder="Account ID" >
        <input type="number" name="deposit_amount" placeholder="Deposit Amount" >
        <button type="submit" name="deposit">Deposit</button>
    </form>

    <!-- Withdraw Form -->
    <form method="POST" action="../control/transaction_processing_control.php">
        <h3>Withdraw Money</h3>
        <input type="number" name="account_id" placeholder="Account ID" >
        <input type="number" name="withdraw_amount" placeholder="Withdraw Amount" >
        <button type="submit" name="withdraw">Withdraw</button>
    </form>

    <!-- Transfer Form -->
    <form method="POST" action="../control/transaction_processing_control.php">
        <h3>Transfer Money</h3>
        <input type="number" name="sender_account_id" placeholder="Sender Account ID" >
        <input type="number" name="receiver_account_id" placeholder="Receiver Account ID" >
        <input type="number" name="transfer_amount" placeholder="Transfer Amount" >
        <button type="submit" name="transfer">Transfer</button>
    </form>

    <br>
    <a href="employee_dashboard.php" class="back-btn">Back to Dashboard</a>
</center>

<?php include 'footer.php'; ?>

</body>
</html>
