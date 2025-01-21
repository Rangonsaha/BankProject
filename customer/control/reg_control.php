<?php
require_once '../model/db.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];

    // Validate Full Name
    $fullName = trim($_POST['fullName'] ?? '');
    $lastName = trim($_POST['lastName'] ?? '');
    if (empty($fullName) || empty($lastName)) {
        $errors[] = "Full name and last name are required.";
    } elseif (strlen($fullName) > 40 || strlen($lastName) > 40) {
        $errors[] = "Name should not exceed 40 characters.";
    }

    // Validate Date of Birth
    $dob = $_POST['dob'] ?? '';
    if (empty($dob)) {
        $errors[] = "Date of Birth is required.";
    }

    // Validate Gender
    $gender = $_POST['gender'] ?? '';
    if (empty($gender)) {
        $errors[] = "Gender is required.";
    }

    // Validate Email
    $email = trim($_POST['email'] ?? '');
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate Phone Number
    $phone = trim($_POST['phone'] ?? '');
    if (empty($phone)) {
        $errors[] = "Phone number is required.";
    } elseif (!preg_match('/^0\d{10}$/', $phone)) {
        $errors[] = "Phone number must start with 0 and be exactly 11 digits.";
    }

    // Validate NID
    $NID = trim($_POST['NID'] ?? '');
    if (empty($NID)) {
        $errors[] = "NID is required.";
    }

    // Validate Address Fields
    $address = trim($_POST['address'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $state = trim($_POST['state'] ?? '');
    $zip = trim($_POST['zip'] ?? '');
    if (empty($address) || empty($city) || empty($state) || empty($zip)) {
        $errors[] = "Address, City, State, and ZIP code are required.";
    }

    // Validate Password
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';
    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 6 || !preg_match('/[a-z]/', $password)) {
        $errors[] = "Password must be at least 6 characters long and contain at least one lowercase letter.";
    }
    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match.";
    }

    // Check for errors
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare user data for JSON file
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
            'password' => $hashedPassword,
        ];

        // 1. Save data to `userdata.json`
        $dataFolder = '../data';
        $dataFile = $dataFolder . '/userdata.json';

        // Check if the 'data' folder exists, if not create it
        if (!is_dir($dataFolder)) {
            mkdir($dataFolder, 0777, true); // Create the folder with write permissions
        }

        // Ensure the JSON file exists and initialize it if not
        if (!file_exists($dataFile)) {
            file_put_contents($dataFile, json_encode([])); // Create an empty array as JSON
        }

        // Load existing data from JSON file
        $existingData = json_decode(file_get_contents($dataFile), true);
        if (!is_array($existingData)) {
            $existingData = [];
        }

        // Add the new user data to the JSON file
        $existingData[] = $userData;

        // Write updated data to JSON file
        $jsonSuccess = file_put_contents($dataFile, json_encode($existingData, JSON_PRETTY_PRINT));

        // 2. Save specific data to MySQL database
        $dbSuccess = addCustomer([
            'Email' => $email,
            'Name' => $fullName . ' ' . $lastName, // Combine full and last name for database
            'Password' => $hashedPassword,
            'Phone' => $phone
        ]);

        // Redirect to login page if both operations succeed
        if ($jsonSuccess && $dbSuccess) {
            header("Location: ../view/login.php");
            exit();
        } elseif ($jsonSuccess) {
            echo "<p style='color:orange;'>Data saved to JSON file, but failed to save to the database.</p>";
        } elseif ($dbSuccess) {
            echo "<p style='color:orange;'>Data saved to the database, but failed to save to the JSON file.</p>";
        } else {
            echo "<p style='color:red;'>Failed to save data to both JSON file and database.</p>";
        }
    }
}
?>
