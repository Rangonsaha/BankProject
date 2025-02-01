<?php
session_start();
require '../model/db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $errors = [];

    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }

    if (empty($errors)) {
        
        $db = new myDB();
        $connection = $db->openCon();

        
        $username_or_email = $email; 
$stmt = $connection->prepare("SELECT * FROM admin WHERE email = ? OR username = ?");
$stmt->bind_param("ss", $email, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        
        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();

            
            if (password_verify($password, $user['password'])) {
                
                $_SESSION['user'] = [
                    'id' => $user['AdminId'], 
                    'email' => $user['email'], 
                ];

                
                if (isset($_POST['remember'])) {
                    setcookie('user_email', $user['email'], time() + (86400 * 30), "/"); // Remember email for 30 days
                }

                
                header("Location: ../view/welcome.php");
                exit();
            } else {
               
                $errors[] = "Invalid email or password.";
            }
        } else {
            
            $errors[] = "Invalid email or password.";
        }

        
        $stmt->close();
        $db->closeCon($connection);
    }

   
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
} else {
   
    header("Location: ../view/login.php");
    exit();
}
?> 