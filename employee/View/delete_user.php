<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

include '../Model/db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = $_POST['email'];

 
    $db = new myDB();
    $connection = $db->openCon();

  
    $sql_delete = "DELETE FROM employee WHERE Email = ?";
    $stmt = $connection->prepare($sql_delete);
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        
        session_unset();
        session_destroy();
        header("Location: ../View/login.php?message=Account deleted successfully.");
        exit;
    } else {
      
        $_SESSION['error_message'] = "Error deleting account: " . $stmt->error;
        header("Location: ../View/home.php");
        exit;
    }

    $stmt->close();
    $db->closeCon($connection);

} else {
    
    header("Location: ../View/home.php");
    exit;
}
?>
