<?php
session_start(); 


if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

require_once '../model/db.php'; 

$db = new myDB();
$admins = $db->getAdmins(); 
$merchants = $db->getMerchants(); 
$employees = $db->getEmployees(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/mystyle.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
<?php include 'header.php'; ?>

    <div class="container">
        <h1 class="welcome-title">Welcome, <?php echo $_SESSION['user']['email']; ?></h1>

        
        <?php if (isset($_SESSION['success'])): ?>
            <p class="success-message"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
        <?php elseif (isset($_SESSION['error'])): ?>
            <p class="error-message"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
        <?php endif; ?>

        
        <nav>
            <ul>
                <li><a href="#admin-section">All Admin Users</a></li>
                <li><a href="#merchant-section">All Merchant Users</a></li>
                <li><a href="#employee-section">All Employee Users</a></li>
                <li><a href="#transaction-section">View Transactions</a></li>
            </ul>
        </nav>

        
        <h2 id="admin-section" class="section-title">All Admin Users</h2>
        <?php
        if ($admins && $admins->num_rows > 0) {
            echo "<table class='user-table'>
                    <tr>
                        <th>Admin ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>";

            while ($row = $admins->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['AdminId'] . "</td>
                        <td>" . $row['full_name'] . "</td>
                        <td>" . $row['email'] . "</td>
                        <td>
                            <a href='admin_update.php?id=" . $row['AdminId'] . "' class='edit-link'>Edit</a>
                        </td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No admin users found.</p>";
        }
        ?>

       
        <h2 id="merchant-section" class="section-title">All Merchant Users</h2>
        <?php
        if ($merchants && $merchants->num_rows > 0) {
            echo "<table class='user-table'>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Business Name</th>
                        <th>Action</th>
                    </tr>";

            while ($row = $merchants->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['Name'] . "</td>
                        <td>" . $row['Email'] . "</td>
                        <td>" . $row['BusinessName'] . "</td>
                        <td>
                            <a href='merchant_update.php?id=" . $row['Name'] . "' class='edit-link'>Edit</a>
                        </td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No merchant users found.</p>";
        }
        ?>
        <div class="add_new_message">
            <h3>Want To Add New Merchant?</h3>
            <a href="merchant_add.php" class="action-link">Add Merchant</a>
        </div>

      
        <h2 id="employee-section" class="section-title">All Employee Users</h2>
        <?php
        if ($employees && $employees->num_rows > 0) {
            echo "<table class='user-table'>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Action</th>
                    </tr>";

            while ($row = $employees->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['Name'] . "</td>
                        <td>" . $row['Email'] . "</td>
                        <td>" . $row['Gender'] . "</td>
                        <td>
                            <a href='employee_update.php?id=" . $row['Name'] . "' class='edit-link'>Edit</a>
                        </td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No employee users found.</p>";
        }
        ?>
        <div class="add_new_message">
            <h3>Want To Add New Employee?</h3>
            <a href="employee_add.php" class="action-link">Add Employee</a>
        </div>

      
        <h2 id="transaction-section" class="section-title">View Transaction Table</h2>
        <div class="transaction-view">
            <a href="transaction_view.php" class="action-link">View Transactions</a>
        </div>

        <br><br>
        <a href="login.php" class="logout-link">Logout</a> <!-- Logout link -->
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
