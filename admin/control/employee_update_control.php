<?php
session_start();


if (!isset($_SESSION['user'])) {
    header("Location: ../view/login.php");
    exit();
}

require_once '../model/db.php'; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $employeeId = isset($_POST['employee_id']) ? $_POST['employee_id'] : '';
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $gender = trim($_POST['gender']);

    
    if (empty($name) || empty($email) || empty($gender)) {
        $_SESSION['error'] = "All fields are required!";
        header("Location: ../view/employee_update.php?id=" . $employeeId);
        exit();
    }

    
    $db = new myDB();
    $connection = $db->openCon();

    
    $stmt = $connection->prepare("UPDATE employee SET Name = ?, Email = ?, Gender = ? WHERE Name = ?");
    $stmt->bind_param("ssss", $name, $email, $gender, $employeeId);

    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Employee data updated successfully!";
        header("Location: ../view/welcome.php");
    } else {
        $_SESSION['error'] = "Error updating employee data!";
        header("Location: ../view/employee_update.php?id=" . $employeeId);
    }

    
    $stmt->close();
    $db->closeCon($connection);
} else {
    
    header("Location: ../view/welcome.php");
    exit();
}
