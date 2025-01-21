<?php
session_start();
require '../model/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    // Validate Full Name (at least 4 characters)
    $full_name = trim($_POST['full_name']);
    if (strlen($full_name) < 4) {
        $errors[] = "Full Name must be at least 4 characters.";
    }

    // Validate Email 
    $email = trim($_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate Phone Number (should be numeric and not longer than 11 digits)
    $phone_number = trim($_POST['phone_number']);
    if (!ctype_digit($phone_number) || strlen($phone_number) > 11) {
        $errors[] = "Phone number must be numeric and not longer than 11 digits.";
    }

    // Validate Branch
    $branch = trim($_POST['branch']);
    if (empty($branch)) {
        $errors[] = "Branch is required.";
    }

    // Validate Date of Birth
    $dob = trim($_POST['dob']);
    if (empty($dob)) {
        $errors[] = "Date of Birth is required.";
    }

    // Validate Username (at least 4 characters)
    $username = trim($_POST['username']);
    if (strlen($username) < 4) {
        $errors[] = "Username must be at least 4 characters.";
    }

    // Validate Password (at least one special character)
    $password = trim($_POST['password']);
    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    } elseif (!preg_match('/[@#$&]/', $password)) {
        $errors[] = "Password must contain at least one special character (@, #, $, &).";
    }

    // Validate Confirm Password
    $confirm_password = trim($_POST['confirm_password']);
    if ($confirm_password != $password) {
        $errors[] = "Passwords do not match.";
    }

    // Validate Role
    $role = trim($_POST['role']);
    if (empty($role)) {
        $errors[] = "Please select a role.";
    }

    // File Upload for ID Proof
    $id_proof = $_FILES['id_proof'];
    if ($id_proof['error'] == 0) {
        $uploadDir = "../uploads/";
        $filePath = $uploadDir . basename($id_proof['name']);
        if (!move_uploaded_file($id_proof['tmp_name'], $filePath)) {
            $errors[] = "Failed to upload ID proof.";
        }
    } else {
        $errors[] = "Please upload a valid ID proof.";
    }

    // If no errors, save data
    if (empty($errors)) {
        $user_data = [
            'full_name' => $full_name,
            'email' => $email,
            'phone_number' => $phone_number,
            'branch' => $branch,
            'dob' => $dob,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT), // Hash password
            'role' => $role,
            'id_proof' => isset($filePath) ? $filePath : "",
        ];

        $data_dir = __DIR__ . '/../data';
        $file_path = $data_dir . '/userdata.json';

        // Ensure data directory exists
        if (!is_dir($data_dir)) {
            mkdir($data_dir, true);
        }

        // Read existing data
        $existing_data = [];
        if (file_exists($file_path)) {
            $json_data = file_get_contents($file_path);
            $existing_data = json_decode($json_data, true) ?? [];
        }

        // Append new data to the JSON file
        $existing_data[] = $user_data;

        // Save to MySQL database
        $db = new myDB();
        $result = $db->insertAdminData($full_name, $email, $user_data['password']);

        if ($result === true) {
            // Save to JSON file
            if (file_put_contents($file_path, json_encode($existing_data, JSON_PRETTY_PRINT))) {
                setcookie('user_email', $email, time() + (86400 * 30), "/"); // Cookie to remember email
                header("Location: ../view/login.php");
                exit();
            } else {
                $errors[] = "Error: Unable to save user data to JSON file.";
            }
        } else {
            $errors[] = "Error: Unable to save user data to the database.";
        }
    }

    // Display errors
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
}
