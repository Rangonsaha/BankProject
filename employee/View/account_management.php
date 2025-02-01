<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Management</title>
    <link rel="stylesheet" href="../CSS/mystyle.css">
    <link rel="stylesheet" href="../CSS/account_management.css">
   
</head>
<body>

<?php include 'header.php'; ?>

<center>
    <h2>Account Management</h2>

    <!-- Display success/error messages -->
    <?php
    if (isset($_SESSION['message'])) {
        echo "<p>{$_SESSION['message']}</p>";
        unset($_SESSION['message']);
    }
    ?>

    <!-- Open Account -->
    <form method="POST" action="../control/account_management_control.php" >
        <h3>Open  Account</h3>
        <input type="text" name="customer_name" placeholder="Customer Name" >
        <input type="email" name="customer_email" placeholder="Customer Email" >
        <select name="account_type" >
            <option value="">Select Account Type</option>
            <option value="Savings">Savings</option>
            <option value="Current">Current</option>
        </select>
        <button type="submit" name="open_account">Open Account</button>
    </form>

    <!-- Close Account -->
    <form method="POST" action="../control/account_management_control.php" >
        <h3>Close Account</h3>
        <input type="number" name="account_id" placeholder="Account ID" >
        <button type="submit" name="close_account">Close Account</button>
    </form>

    <!-- Update Account -->
    <form method="POST" action="../control/account_management_control.php" >
        <h3>Update Account Type</h3>
        <input type="number" name="account_id" placeholder="Account ID" >
        <select name="new_account_type" >
            <option value="">Select New Account Type</option>
            <option value="Savings">Savings</option>
            <option value="Current">Current</option>
        </select>
        <button type="submit" name="update_account">Update Account</button>
    </form>

    <br>
    <a href="employee_dashboard.php" class="back-btn">Back to Dashboard</a>
</center>

<?php include 'footer.php'; ?>

</body>
</html>
