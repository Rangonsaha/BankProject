<?php
session_start();
include('header.php');

// Check if the user is logged in
if (!isset($_SESSION['merchant_name'])) {
    // Redirect to the login page if not logged in
    header("Location: ../views/login.php");
    exit();
}

// Get the merchant's name from the session
$merchantName = $_SESSION['merchant_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchant Dashboard</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>

    <!-- Main Dashboard Container -->
    <div class="dashboard-container">
        <div class="dashboard-header">
            <!-- Welcome Message -->
            <h2>Welcome, <?php echo htmlspecialchars($merchantName); ?>!</h2>
        </div>

        <!-- Dashboard Stats -->
        <div class="dashboard-stats">
            <div class="stat-box">
                <h3>Pending Loans</h3>
                <a href="approve_loans.php" class="btn">View Pending Loans</a>
            </div>

            <div class="stat-box">
                <h3>Feedbacks</h3>
                <a href="manage_feedbacks.php" class="btn">Manage Feedbacks</a>
            </div>

            <div class="stat-box">
                <h3>Your Profile</h3>
                <p>Update your personal information.</p>
                <a href="profile.php" class="btn">Go to Profile</a>
            </div>

            <!-- New Stat Box for Managing Customers -->
            <div class="stat-box">
                <h3>Manage Customers</h3>
                <p>View and manage your customer details.</p>
                <a href="manage_customers.php" class="btn">Manage Customers</a>
            </div>
        </div>
    </div>

</body>
</html>

<?php include('footer.php'); ?>
