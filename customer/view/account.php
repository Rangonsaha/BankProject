<?php
session_start();
require_once '../model/db.php';

// Ensure the customer is logged in
if (!isset($_SESSION['CustomerId'])) {
    header("Location: ../view/login.php"); // Redirect to login page if not logged in
    exit();
}

// Get customer details
$customerId = $_SESSION['CustomerId'];
$conn = connectDB();

// Fetch customer details
$sqlCustomer = "SELECT * FROM customer WHERE CustomerId = :CustomerId";
$stmtCustomer = $conn->prepare($sqlCustomer);
$stmtCustomer->bindParam(':CustomerId', $customerId);
$stmtCustomer->execute();
$customer = $stmtCustomer->fetch(PDO::FETCH_ASSOC);

// Fetch bank account details for the customer
$sqlAccount = "SELECT * FROM bankaccount WHERE CustomerId = :CustomerId LIMIT 1";
$stmtAccount = $conn->prepare($sqlAccount);
$stmtAccount->bindParam(':CustomerId', $customerId);
$stmtAccount->execute();
$account = $stmtAccount->fetch(PDO::FETCH_ASSOC);

// If no account found, prompt user to create one
if (!$account) {
    header("Location: ../view/createAccount.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Customer Dashboard</title>
    <link rel="stylesheet" href="../css/account.css">
</head>
<body>
    <center>
        <h1>Welcome, <?php echo htmlspecialchars($customer['Name']); ?></h1>

        <h2>Your Bank Account</h2>
        <table>
            <tr>
                <td><strong>Account ID:</strong></td>
                <td><?php echo $account['AccountId']; ?></td>
            </tr>
            <tr>
                <td><strong>Account Type:</strong></td>
                <td><?php echo htmlspecialchars($account['AccountType']); ?></td>
            </tr>
            <tr>
                <td><strong>Balance:</strong></td>
                <td>$<?php echo number_format($account['Balance'], 2); ?></td>
            </tr>
            <tr>
                <td><strong>Created On:</strong></td>
                <td><?php echo date("F j, Y, g:i a", strtotime($account['CreatedDate'])); ?></td>
            </tr>
        </table>

        <br>
        <a href="../control/logout.php">
            <button class="button">Logout</button>
        </a>
    </center>
</body>
</html>
