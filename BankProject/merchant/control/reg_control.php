<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    // Validate Full Name (at least 4 characters)
    $merchant_name = trim($_POST['merchant_name']);
    if (strlen($merchant_name) < 4) {
        $errors[] = "Full Name must be at least 4 characters.";
    }

    // Validate Email 
    $email = trim($_POST['email']);
    if (!preg_match("/^[a-zA-Z0-9._%+-]+@aiub\.edu$/", $email)) {
        $errors[] = "Email is required and must be a valid aiub.edu email address.";
    }

    // Validate Password (at least 6 characters)
    $password = trim($_POST['password']);
    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }

    // Validate Business Name
    $business_name = trim($_POST['business_name']);
    if (empty($business_name)) {
        $errors[] = "Business Name is required.";
    }

    // Validate Business Registration Number
    $business_reg_number = trim($_POST['business_reg_number']);
    if (empty($business_reg_number)) {
        $errors[] = "Business Registration Number is required.";
    }

    // Validate Business Type
    $business_type = trim($_POST['business_type']);
    if (empty($business_type)) {
        $errors[] = "Business Type is required.";
    }

    // Validate Business Address
    $business_address = trim($_POST['business_address']);
    if (empty($business_address)) {
        $errors[] = "Business Address is required.";
    }

    // Validate Contact Number
    $contact_number = trim($_POST['contact_number']);
    if (!ctype_digit($contact_number)) {
        $errors[] = "Contact Number must contain only numbers.";
    }

    $business_website = trim($_POST['business_website']);
    if (!empty($business_website) && !filter_var($business_website, FILTER_VALIDATE_URL)) {
        $errors[] = "Business Website must be a valid URL.";
    }

    $payment_method = $_POST['payment_method'];
    if (empty($payment_method)) {
        $errors[] = "Please select a payment method.";
    }

    if (empty($errors)) {
        $user_data = [
            'merchant_name' => $merchant_name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT), // Hash the password
            'business_name' => $business_name,
            'business_reg_number' => $business_reg_number,
            'business_type' => $business_type,
            'business_address' => $business_address,
            'contact_number' => $contact_number,
            'business_website' => $business_website,
            'payment_method' => $payment_method,
        ];

        $data_dir = __DIR__ . '/../data';
        $file_path = $data_dir . '/userdata.json';

        if (!is_dir($data_dir)) {
            mkdir($data_dir,  true);
        }

        $existing_data = [];
        if (file_exists($file_path)) {
            $json_data = file_get_contents($file_path);
            $existing_data = json_decode($json_data, true) ?? [];
        }

        $existing_data[] = $user_data;

        if (file_put_contents($file_path, json_encode($existing_data, JSON_PRETTY_PRINT))) {
            setcookie('user_email', $email, time() + (86400 * 30), "/"); // Cookie to remember email
            echo "User data successfully saved to userdata.json.";
        } else {
            echo "Error: Unable to save user data.";
        }
    } else {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
}