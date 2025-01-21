<?php
session_start();
require '../model/db.php'; // Include your database handling class

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve inputs
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $errors = [];

    // Input validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }

    if (empty($errors)) {
        // Create database object
        $db = new myDB();
        $connection = $db->openCon();

        // Prepare and execute query to fetch user data
        $stmt = $connection->prepare("SELECT * FROM admin WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if user exists
        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Password is correct, store user data in session
                $_SESSION['user'] = [
                    'id' => $user['AdminId'], // Store the user's ID in session
                    'email' => $user['email'], // Store the user's email in session
                ];

                // Redirect to welcome page
                header("Location: ../view/welcome.php");
                exit();
            } else {
                // Password is incorrect
                $errors[] = "Invalid email or password.";
            }
        } else {
            // No user found with that email
            $errors[] = "Invalid email or password.";
        }

        // Close the prepared statement and database connection
        $stmt->close();
        $db->closeCon($connection);
    }

    // If there are errors, display them
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
} else {
    // Redirect to login page if the form is not submitted via POST
    header("Location: ../view/login.php");
    exit();
}
