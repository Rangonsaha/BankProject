<?php
session_start(); // Start the session to handle session data
include '../model/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $file_path = __DIR__ . '/../data/userdata.json';

    // Check if the userdata file exists
    if (file_exists($file_path)) {
        $json_data = file_get_contents($file_path);
        $users = json_decode($json_data, true) ?? [];

        // Loop through users and verify email and password
        foreach ($users as $user) {
            if ($user['email'] === $email && password_verify($password, $user['password'])) {
                // Set session variables for the logged-in user
                $_SESSION['loggedin_user'] = $user;
                $_SESSION['loggedin'] = true;

                // Initialize DB connection
                $db = new myDB();
                $connection = $db->openCon();

                // Check if the user already exists in the merchant table by email
                $sql_check = "SELECT * FROM merchant WHERE Email = ?";
                $stmt_check = $connection->prepare($sql_check);
                $stmt_check->bind_param("s", $email);
                $stmt_check->execute();
                $result_check = $stmt_check->get_result();

                // If user already exists in the merchant table, do not insert data again
                if ($result_check->num_rows > 0) {
                    // Optionally, you can redirect to the dashboard page here instead of echoing
                    $_SESSION['message'] = "User data already exists in the database.";
                } else {
                    // Ensure password is hashed before saving
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    $merchant_name = $user['merchant_name'];
                    $business_name = $user['business_name'];

                    // Insert user data into the merchant table
                    $sql_insert = "INSERT INTO merchant (Name, Email, Password, BusinessName) 
                                   VALUES (?, ?, ?, ?)";
                    $stmt_insert = $connection->prepare($sql_insert);

                    if ($stmt_insert) {
                        $stmt_insert->bind_param("ssss", $merchant_name, $email, $hashed_password, $business_name);

                        if ($stmt_insert->execute()) {
                            $_SESSION['message'] = "Data inserted successfully into the merchant table.";
                        } else {
                            $_SESSION['error_message'] = "Error inserting data: " . $stmt_insert->error;
                        }

                        $stmt_insert->close();
                    } else {
                        $_SESSION['error_message'] = "Error preparing statement: " . $connection->error;
                    }
                }

                $stmt_check->close();
                $db->closeCon($connection);

                // Redirect to the welcome page or dashboard after successful login
                header('Location: ../views/welcome.php');
                exit;
            }
        }

        // If no matching user is found
        $_SESSION['error_message'] = "Email or password is incorrect. Please try again.";
    } else {
        $_SESSION['error_message'] = "No user data found. Please register first.";
    }

    // Redirect to the login page with the error message if no match
    header('Location: ../views/login.php');
    exit;
}
?>
