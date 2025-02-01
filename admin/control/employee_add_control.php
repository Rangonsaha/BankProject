<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

require_once '../model/db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];  
   

    $db = new myDB();

    
    $result = $db->insertData(
        'employee', 
        ['Name', 'Email', 'Gender', 'Password'], 
        [$name, $email, $gender, $password]  
    );

    if ($result === true) {
        $_SESSION['success'] = "Employee added successfully!";
    } else {
        $_SESSION['error'] = "Error adding employee.";
    }

    header("Location: ../view/welcome.php"); 
    exit();
}
