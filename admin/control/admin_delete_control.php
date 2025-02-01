<?php
session_start();


if (!isset($_SESSION['user'])) {
    header("Location: ../view/login.php");
    exit();
}

require_once '../model/db.php'; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $adminId = isset($_POST['admin_id']) ? intval($_POST['admin_id']) : 0; 

    if ($adminId > 0) {
        
        $db = new myDB();
        $connection = $db->openCon();

       
        $stmt = $connection->prepare("DELETE FROM admin WHERE AdminId = ?");
        $stmt->bind_param("i", $adminId);

        
        if ($stmt->execute()) {
            $_SESSION['success'] = "Admin deleted successfully!";
        } else {
            $_SESSION['error'] = "Error deleting admin data!";
        }

        
        $stmt->close();
        $db->closeCon($connection);
    } else {
        $_SESSION['error'] = "Invalid admin ID!";
    }

    
    header("Location: ../view/welcome.php");
    exit();
} else {
    
    header("Location: ../view/welcome.php");
    exit();
}
?>
