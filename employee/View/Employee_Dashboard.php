<?php
session_start();

// Check if employee is logged in
if (!isset($_SESSION['employee_logged_in'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <link rel="stylesheet" href="../CSS/dashboard.css">
</head>
<body>

<header class="header">
    <div class="container">
    <h1>Employee Portal</h1>
        <nav>
            <a href="account_management.php">Accounts</a>
            <a href="transaction_processing.php">Transactions</a>
            <a href="loan_processing.php">Loans</a>
            <a href="schedule_appointment.php">Appointment</a>
            <a href="../control/logout.php" class="logout">Logout</a>
        </nav>
    </div>
</header>

<main class="dashboard">
    <div class="container">
        <h2>Welcome, Sayed Arifin!</h2>
        <br>

        <div class="dashboard-grid">
            <div class="dashboard-card">
                <h3>Account Management</h3>
                <p>Open, close, or update customer accounts effortlessly.</p>
                <a href="account_management.php" class="btn">Manage Accounts</a>
            </div>
            <div class="dashboard-card">
                <h3>Transaction Processing</h3>
                <p>Process deposits, withdrawals, and fund transfers seamlessly.</p>
                <a href="transaction_processing.php" class="btn">Process Transactions</a>
            </div>
            <div class="dashboard-card">
                <h3>Loan Processing</h3>
                <p>Review, approve, or reject loan applications efficiently.</p>
                <a href="loan_processing.php" class="btn">Manage Loans</a>
            </div>
            
                <div class="dashboard-card">
                <h3>Schedule Appointment</h3>
                <p>Scheduling appointments for customers who require in-person assistance  </p>
                <a href="schedule_appointment.php" class="btn">Manage Appointment</a>
            </div>
           
        </div>
    </div>
</main>


<?php include 'footer.php'; ?>
</body>
</html>
