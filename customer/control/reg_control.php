<?php
require_once '../model/db.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];

    // Get and validate the form fields
    $fullName = trim($_POST['fullName'] ?? '');
    $lastName = trim($_POST['lastName'] ?? '');
    $dob = $_POST['dob'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $NID = trim($_POST['NID'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $state = trim($_POST['state'] ?? '');
    $zip = trim($_POST['zip'] ?? '');
    $password = $_POST['password'] ?? ''; // Plain text password
    $confirmPassword = $_POST['confirmPassword'] ?? '';

    // Validate inputs as usual

    // Save data to the database (no hashing)
    $userData = [
        'fullName' => $fullName,
        'lastName' => $lastName,
        'dob' => $dob,
        'gender' => $gender,
        'email' => $email,
        'phone' => $phone,
        'NID' => $NID,
        'address' => $address,
        'city' => $city,
        'state' => $state,
        'zip' => $zip,
        'password' => $password, // Plain password
    ];

    // Add customer to the database without hashing the password
    $dbSuccess = addCustomer([
        'Email' => $email,
        'Name' => $fullName . ' ' . $lastName,
        'Password' => $password, // Plain password
        'Phone' => $phone,
    ]);

    if ($dbSuccess) {
        header("Location: ../view/login.php");
        exit();
    } else {
        echo "<p style='color:red;'>Failed to save data to the database.</p>";
    }
}
?>
