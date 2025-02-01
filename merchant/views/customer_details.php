<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details</title>
    <link rel="stylesheet" href="../css/customer_details.css">
</head>
<body>

    <?php include('header.php'); ?>

    <div class="container">
        <h1>Customer Details</h1>
        <label for="customerSelect">Select Customer:</label>
        <select id="customerSelect" onchange="fetchCustomerDetails()">
            <!-- Options will be dynamically added here -->
        </select>
        <div id="customerDetails" class="card">
            <p><strong>Name:</strong> <span id="customerName"></span></p>
            <p><strong>Email:</strong> <span id="customerEmail"></span></p>
            <p><strong>Phone:</strong> <span id="customerPhone"></span></p>
        </div>
    </div>
    <script src="../js/customer_details.js"></script>

    <?php include('footer.php'); ?>
</body>
</html>