<?php
session_start();


if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

require_once '../model/db.php';


$merchantId = isset($_GET['id']) ? $_GET['id'] : '';

if ($merchantId) {
    $db = new myDB();
    $connection = $db->openCon();

  
    $stmt = $connection->prepare("SELECT * FROM merchant WHERE Name = ?");
    $stmt->bind_param("s", $merchantId);
    $stmt->execute();
    $result = $stmt->get_result();
    $merchantData = $result->fetch_assoc();

   
    $stmt->close();
    $db->closeCon($connection);

    if (!$merchantData) {
        header("Location: welcome.php");
        exit();
    }
} else {
    header("Location: welcome.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/mystyle.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Merchant</title>
</head>
<body>
<?php include 'header.php'; ?>
    <h1>Update Merchant Data</h1>

    <?php if (isset($_SESSION['success'])): ?>
        <p class="success-message"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
    <?php elseif (isset($_SESSION['error'])): ?>
        <p class="error-message"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>

   
    <form action="../control/merchant_update_control.php" method="POST">
        <input type="hidden" name="merchant_id" value="<?php echo $merchantData['Name']; ?>">

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $merchantData['Name']; ?>">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo $merchantData['Email']; ?>">
        </div>

        <div class="form-group">
            <label for="business_name">Business Name:</label>
            <input type="text" id="business_name" name="business_name" value="<?php echo $merchantData['BusinessName']; ?>">
        </div>

        <button type="submit">Update Merchant</button>
    </form>

    
    <form action="../control/merchant_delete_control.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this merchant?');">
        <input type="hidden" name="merchant_id" value="<?php echo $merchantData['Name']; ?>">
        <button type="submit" class="delete-button">Delete Merchant</button>
    </form>

    <br><br>
    <a href="welcome.php">Back to Welcome Page</a>
    <?php include 'footer.php'; ?>
</body>
</html>
