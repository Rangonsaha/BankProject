<?php
session_start();
require_once('../model/db.php');

// Ensure the merchant is logged in
if (!isset($_SESSION['merchant_id'])) {
    header('Location: login.php');
    exit();
}

$merchant_id = $_SESSION['merchant_id'];

// Collect form data from the previous page
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$business_name = trim($_POST['business_name']);
$password = trim($_POST['password']);

// Validate input (this can be improved further)
if (!empty($name) && !empty($email) && !empty($business_name) && !empty($password)) {
    // Update merchant details
    if (updateMerchantDetails($merchant_id, $name, $email, $business_name, $password)) {
        $_SESSION['message'] = "Profile updated successfully.";
        header("Location: ../views/edit_profile.php");
        exit();
    } else {
        $_SESSION['message'] = "Error updating profile. Please try again.";
        header("Location: ../views/edit_profile.php");
        exit();
    }
} else {
    $_SESSION['message'] = "All fields are required.";
    header("Location: ../views/edit_profile.php");
    exit();
}
