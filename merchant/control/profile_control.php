<?php
session_start();
require_once('../model/db.php');

// Check if the session contains a valid merchant_id
if (!isset($_SESSION['merchant_id'])) {
    echo "Merchant ID is not set in session!";
    exit();
}

$merchantId = $_SESSION['merchant_id'];

// Check if the merchant exists by their ID
$merchant = getMerchantById($merchantId);

if ($merchant) {
    // Merchant found, proceed with rendering profile
    $_SESSION['merchant_name'] = $merchant['Name'];
    $_SESSION['merchant_email'] = $merchant['Email'];
    $_SESSION['merchant_business_name'] = $merchant['BusinessName'];
    // Render merchant profile page here
} else {
    echo "No merchant data found for MerchantId: $merchantId";
}
?>
