<?php
session_start();
require_once('../model/db.php');

// Ensure the merchant is logged in
if (!isset($_SESSION['merchant_id'])) {
    header('Location: login.php');
    exit();
}

$merchant_id = $_SESSION['merchant_id'];
$merchant_data = getMerchantById($merchant_id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $business_name = trim($_POST['business_name']);
    $password = trim($_POST['password']);

    // Update merchant details
    if (updateMerchantDetails($merchant_id, $name, $email, $business_name, $password)) {
        $message = "Profile updated successfully.";
    } else {
        $message = "Unable to update profile. Please try again.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../css/edit_profile.css">
</head>
<body>

<?php include('header.php'); ?>

    <div class="profile-container">
        <h2>Edit Your Profile</h2>
        
        <?php if (isset($message)) { echo "<p style='color: green;'>$message</p>"; } ?>
        
        <!-- Profile Edit Form -->
        <form action="edit_profile.php" method="POST">
            <div class="profile-details">
                <p><strong>Business Name:</strong><br>
                <input type="text" name="business_name" value="<?php echo htmlspecialchars($merchant_data['BusinessName']); ?>" required></p>
                
                <p><strong>Merchant Name:</strong><br>
                <input type="text" name="name" value="<?php echo htmlspecialchars($merchant_data['Name']); ?>" required></p>
                
                <p><strong>Email:</strong><br>
                <input type="email" name="email" value="<?php echo htmlspecialchars($merchant_data['Email']); ?>" required></p>
                
                <p><strong>Password:</strong><br>
                <input type="password" name="password" value="<?php echo htmlspecialchars($merchant_data['Password']); ?>" required></p>
            </div>
            
            <button type="submit" class="btn">Update Profile</button>
        </form>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>


