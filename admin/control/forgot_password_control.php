<?php
session_start();
require '../model/db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = trim($_POST['email']);
    $errors = [];

  
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($errors)) {
        
        $db = new myDB();
        $connection = $db->openCon();

        
        $stmt = $connection->prepare("SELECT * FROM admin WHERE LOWER(email) = LOWER(?)");
        $stmt->bind_param("s", $email); // Bind email
        $stmt->execute();
        $result = $stmt->get_result();

       
        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();

           
            $resetToken = bin2hex(random_bytes(16)); 
            $resetLink = "https://asadmim70@gmail.com/reset_password.php?token=$resetToken"; 

          
            $updateStmt = $connection->prepare("UPDATE admin SET reset_token = ? WHERE email = ?");
            $updateStmt->bind_param("ss", $resetToken, $email);
            $updateStmt->execute();

            
            $to = $email;
            $subject = "Password Reset Request";
            $message = "Click here to reset your password: <a href='$resetLink'>Reset</a>";
            $headers = "From: no-reply@yourdomain.com" . "\r\n" . "Content-Type: text/html; charset=UTF-8";

            $mail_sent = @mail($to, $subject, $message, $headers);

            if (!$mail_sent) {
                
                echo "<p>Error sending email. Please try again later.</p>";
            } else {
               
                echo "<p>Password reset email sent successfully. Please check your inbox.</p>";
            }

            
            $updateStmt->close();
        } else {
            
            echo "<p>Email address not found. Please check your email and try again.</p>";
        }

        
        $stmt->close();
        $db->closeCon($connection);
    } else {
        
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
} else {
    
    header("Location: ../view/login.php");
    exit();
}
?>
