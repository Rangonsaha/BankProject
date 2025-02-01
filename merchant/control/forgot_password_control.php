<?php
session_start();

require_once('../model/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);

    // Check if email exists
    if (emailExists($email)) {
        echo "Password reset link has been sent to your email address.";
    } else {
        echo "This email is not registered.";
    }
}
?>
