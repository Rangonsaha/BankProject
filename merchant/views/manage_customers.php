<?php
session_start();
require_once('../control/manage_customers_control.php'); // Include control file to fetch customers

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Customers</title>
    <link rel="stylesheet" href="../css/manage_customers.css">
</head>
<body>

    <?php include('header.php'); ?>

    <div class="manage-customers-container">
        <h2>Manage Customers</h2>

        <?php if (!empty($customers)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Customer ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($customers as $customer): ?>
                        <tr>
                            <td><?php echo $customer['CustomerId']; ?></td>
                            <td><?php echo htmlspecialchars($customer['Name']); ?></td>
                            <td><?php echo htmlspecialchars($customer['Email']); ?></td>
                            <td><?php echo htmlspecialchars($customer['Phone']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No customers found.</p>
        <?php endif; ?>

    </div>

    <?php include('footer.php'); ?>

</body>
</html>
