<?php
// Include the database model
require_once('../model/db.php');

// Start session to manage user login state
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Check if email and password are provided
    if (empty($email) || empty($password)) {
        echo "<p style='color:red;'>Email and Password are required.</p>";
    } else {
        // Fetch user from the database
        $user = getUserByEmail($email);

        // Debugging: Print the user data to see if it exists
        if ($user) {
            echo "<pre>";
            print_r($user); // This will display the entire user data array
            echo "</pre>";
        } else {
            echo "<p style='color:red;'>No account found with this email.</p>";
        }

        if ($user && isset($user['password'])) { // Corrected key from 'Password' to 'password'
            // Verify password
            if (password_verify($password, $user['password'])) { // Use lowercase 'password' here as well
                // Set session variables
                $_SESSION['user_id'] = $user['CustomerId'];
                $_SESSION['email'] = $user['Email'];
                $_SESSION['name'] = $user['Name'];

                // Redirect to the dashboard or homepage
                header('Location: ../view/dashboard.php');
                exit();
            } else {
                echo "<p style='color:red;'>Incorrect password.</p>";
            }
        } else {
            echo "<p style='color:red;'>User not found or invalid data.</p>";
        }
    }
}
?>
