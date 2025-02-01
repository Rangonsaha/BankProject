<?php
// Ensure the user is logged in before accessing the homepage
session_start();
if (!isset($_SESSION['CustomerId'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main class="main-content">
        <section class="welcome-section">
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['Name']); ?>!</h2>
        </section>

        <section class="quick-actions">
            <h3>Quick Actions</h3>
            <div class="action-cards">
                <div class="card">
                    <h4>Transfer Funds</h4>
                    <p>Send money securely and instantly.</p>
                    <a href="transaction.php" class="button">Start Transfer</a>
                </div>
                <div class="card">
                    <h4>Manage Loans</h4>
                    <p>Check your loan status and apply for a new loan.</p>
                    <a href="loan.php" class="button">Manage Loans</a>
                </div>
                <div class="card">
                    <h4>Update Profile</h4>
                    <p>Keep your account details up-to-date.</p>
                    <a href="profile.php" class="button">Edit Profile</a>
                </div>
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
