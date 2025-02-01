<?php
session_start();


if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

require_once '../model/db.php';


if (isset($_POST['employee_id']) && !empty($_POST['employee_id'])) {
    $employeeId = $_POST['employee_id'];

   
    $db = new myDB();
    $connection = $db->openCon();

    
    $stmt = $connection->prepare("DELETE FROM employee WHERE Name = ?");
    $stmt->bind_param("s", $employeeId);

    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Employee deleted successfully!";
    } else {
        $_SESSION['error'] = "Error deleting employee!";
    }

    
    $stmt->close();
    $db->closeCon($connection);


    header("Location: ../view/welcome.php");
    exit();
} else {
    
    header("Location: ../view/welcome.php");
    exit();
}
?>
