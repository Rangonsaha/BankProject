<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../view/login.php");
    exit();
}

require_once '../model/db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $merchantId = isset($_POST['merchant_id']) ? $_POST['merchant_id'] : '';
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $businessName = trim($_POST['business_name']);

   
    if (empty($name) || empty($email) || empty($businessName)) {
        $_SESSION['error'] = "All fields are required!";
        header("Location: ../view/merchant_update.php?id=" . $merchantId);
        exit();
    }

   
    $db = new myDB();
    $connection = $db->openCon();

   
    $stmt = $connection->prepare("UPDATE merchant SET Name = ?, Email = ?, BusinessName = ? WHERE Name = ?");
    $stmt->bind_param("ssss", $name, $email, $businessName, $merchantId);

    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Merchant data updated successfully!";
        header("Location: ../view/welcome.php");
    } else {
        $_SESSION['error'] = "Error updating merchant data!";
        header("Location: ../view/merchant_update.php?id=" . $merchantId);
    }

   
    $stmt->close();
    $db->closeCon($connection);
} else {
    
    header("Location: ../view/welcome.php");
    exit();
}
