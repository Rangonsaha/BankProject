<?php
session_start();

if (!isset($_SESSION['user'])) {
    
    echo json_encode(['success' => false, 'error' => 'User is not logged in']);
    exit();
}

require_once '../model/db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $business_name = $_POST['business_name'];
    $password = $_POST['password']; 

    $db = new myDB();

    
    $result = $db->insertData(
        'merchant', 
        ['Name', 'Email', 'BusinessName', 'Password'], 
        [$name, $email, $business_name, $password]  
    );

    if ($result === true) {
        
        echo json_encode(['success' => true]);
    } else {
        
        echo json_encode(['success' => false, 'error' => 'Error adding merchant']);
    }

    exit();
}
