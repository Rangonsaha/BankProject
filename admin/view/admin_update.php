<?php
session_start();


if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

require_once '../model/db.php'; 


$adminId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($adminId > 0) {
    $db = new myDB();
    $connection = $db->openCon();

  
    $stmt = $connection->prepare("SELECT * FROM admin WHERE AdminId = ?");
    $stmt->bind_param("i", $adminId);
    $stmt->execute();
    $result = $stmt->get_result();
    $adminData = $result->fetch_assoc();

   
    $stmt->close();
    $db->closeCon($connection);

    if (!$adminData) {
       
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
    <title>Update Admin Data</title>
</head>
<body>
<?php include 'header.php'; ?>
    <h1>Update Admin Data</h1>

    
    <?php if (isset($_SESSION['success'])): ?>
        <p class="success-message"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
    <?php elseif (isset($_SESSION['error'])): ?>
        <p class="error-message"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>

    
    <form action="../control/admin_update_control.php" method="POST">
        <input type="hidden" name="admin_id" value="<?php echo $adminData['AdminId']; ?>">

        <div class="form-group">
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" value="<?php echo $adminData['full_name']; ?>">
        </div>

        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo $adminData['username']; ?>">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo $adminData['email']; ?>">
        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" value="<?php echo $adminData['phone_number']; ?>">
        </div>

        <div class="form-group">
            <label for="role">Role:</label>
            <input type="text" id="role" name="role" value="<?php echo $adminData['role']; ?>">
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo $adminData['address']; ?>">
        </div>

        <div class="form-group">
            <label for="security_question">Security Question:</label>
            <input type="text" id="security_question" name="security_question" value="<?php echo $adminData['security_question']; ?>">
        </div>

        <div class="form-group">
            <label for="default_language">Default Language:</label>
            <input type="text" id="default_language" name="default_language" value="<?php echo $adminData['default_language']; ?>">
        </div>

        <div class="form-group">
            <label for="time_zone">Time Zone:</label>
            <input type="text" id="time_zone" name="time_zone" value="<?php echo $adminData['time_zone']; ?>">
        </div>

        <button type="submit">Update Admin</button>
    </form>

   
    <form action="../control/admin_delete_control.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this admin?');">
        <input type="hidden" name="admin_id" value="<?php echo $adminData['AdminId']; ?>">
        <button type="submit" class="delete-button">Delete Admin</button>
    </form>

    <br><br>
    <a href="welcome.php">Back to Welcome Page</a>
    <?php include 'footer.php'; ?>
</body>
</html>
