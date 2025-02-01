<?php

require_once('../model/db.php');
require_once('../control/profile_control.php');

// Check if merchant_id session variable is set
if (!isset($_SESSION['merchant_id'])) {
    echo "Merchant not logged in! Please log in to view your profile.";
    exit(); // Stop further execution if not logged in
}

// Get the merchant ID from the session
$merchantId = $_SESSION['merchant_id'];

// Fetch merchant data from the database using the function
$merchantData = getMerchantById($merchantId);

// Check if the merchant data was fetched successfully
if ($merchantData) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Merchant Profile</title>
        <link rel="stylesheet" href="../css/profile.css">
    </head>
    <body>

    <?php include('header.php'); ?>

        <!-- Main Profile Container -->
        <div class="profile-container">
            <h2>Merchant Profile</h2>
            <p>Here are the details of your account:</p>

            <div class="profile-details">
                <p><strong>Business Name:</strong> <?php echo htmlspecialchars($merchantData['BusinessName']); ?></p>
                <p><strong>Merchant Name:</strong> <?php echo htmlspecialchars($merchantData['Name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($merchantData['Email']); ?></p>
                <p><strong>Merchant ID:</strong> <?php echo htmlspecialchars($merchantData['MerchantId']); ?></p>
            </div>

            <a href="edit_profile.php" class="btn">Edit Profile</a>
        </div>

        <?php include('footer.php'); ?>

    </body>
    </html>
    <?php
} else {
    // If merchant data not found, show an error message
    echo "Unable to fetch merchant details. Please try again later.";
}

?>
