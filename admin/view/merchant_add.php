<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/mystyle.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Merchant</title>
    <script src="../js/add_merchant.js"></script>  
</head>
<body>
<?php include 'header.php'; ?>
    
    <h1>Add New Merchant</h1>

    <form id="merchantForm">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email">
        </div>

        <div class="form-group">
            <label for="business_name">Business Name:</label>
            <input type="text" id="business_name" name="business_name">
        </div>

        
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
        </div>

        <button type="button" onclick="submitForm()">Add Merchant</button>
    </form>

    <br><br>
    <a href="welcome.php">Back to Welcome Page</a>
    <?php include 'footer.php'; ?>
</body>
</html>
