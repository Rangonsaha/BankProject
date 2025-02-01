<?php
session_start();

// Include the database connection and functions
require_once('../model/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    // Validate Email
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate Password
    $password = trim($_POST['password']);
    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    if (empty($errors)) {
        // Check if the email exists in the database
        $merchant = getMerchantByEmail($email);

        if ($merchant) {
            // Debugging: Output the merchant details to confirm the email match
            echo "<pre>";
            print_r($merchant); // Display all merchant data from the database
            echo "</pre>";

            // Compare the entered password with the stored plain-text password
            if ($password === $merchant['Password']) {
                // Set session variables
                $_SESSION['merchant_id'] = $merchant['MerchantId'];
                $_SESSION['merchant_name'] = $merchant['Name'];
                $_SESSION['merchant_email'] = $merchant['Email'];

                // Debugging: Output session data to confirm it's set
                echo "<pre>";
                print_r($_SESSION); // Display session variables
                echo "</pre>";

                // Redirect to the dashboard or profile page
                header("Location: ../views/dashboard.php");
                exit();
            } else {
                $errors[] = "Invalid password.";
            }
        } else {
            $errors[] = "No account found with this email.";
        }
    }

    // Display errors if any
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    }
}
?>
