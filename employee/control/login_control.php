<?php
session_start();
include '../Model/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $file_path = __DIR__ . '/../data/userdata.json';

   
    if (file_exists($file_path)) {
        $json_data = file_get_contents($file_path);
        $users = json_decode($json_data, true) ?? [];

 
        foreach ($users as $user) {
            if ($user['email'] === $email && $user['password'] === $password) {
               
                $_SESSION['loggedin_user'] = $user;
                $_SESSION['loggedin'] = true;

               
                $db = new myDB();
                $connection = $db->openCon();

               
                $sql_check = "SELECT * FROM employee WHERE Email = ?";
                $stmt_check = $connection->prepare($sql_check);
                $stmt_check->bind_param("s", $email);
                $stmt_check->execute();
                $result_check = $stmt_check->get_result();

               
                if ($result_check->num_rows > 0) {
                    $_SESSION['message'] = "User data already exists in the employee database.";
                } else {
                   
                    $name = $user['firstName'] . ' ' . $user['lastName'];
                    $gender = $user['gender'];

                    $sql_insert = "INSERT INTO employee (Name, Email, Password, Gender) 
                                   VALUES (?, ?, ?, ?)";
                    $stmt_insert = $connection->prepare($sql_insert);

                    if ($stmt_insert) {
                        $stmt_insert->bind_param("ssss", $name, $email, $user['password'], $gender);

                        if ($stmt_insert->execute()) {
                            $_SESSION['message'] = "Data inserted successfully into the employee table.";
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

                
                header('Location: ../view/home.php');
                exit;
            }
        }

      
        $_SESSION['error_message'] = "Email or password is incorrect. Please try again.";
    } else {
        $_SESSION['error_message'] = "No user data found. Please register first.";
    }

    
    header('Location: ../view/login.php');
    exit;
}
?>
