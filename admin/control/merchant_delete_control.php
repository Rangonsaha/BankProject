<?php
session_start();


if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

require_once '../model/db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $merchantId = isset($_POST['merchant_id']) ? $_POST['merchant_id'] : '';

    if ($merchantId) {
        $db = new myDB();
        $connection = $db->openCon();

       
        $stmt = $connection->prepare("DELETE FROM merchant WHERE Name = ?");
        $stmt->bind_param("s", $merchantId);

        
        if ($stmt->execute()) {
            $_SESSION['success'] = "Merchant deleted successfully!";
            header("Location: ../view/welcome.php");
        } else {
            $_SESSION['error'] = "Error deleting merchant!";
            header("Location: ../view/merchant_update.php?id=" . $merchantId);
        }

        
        $stmt->close();
        $db->closeCon($connection);
    } else {
        $_SESSION['error'] = "No merchant ID provided!";
        header("Location: ../view/welcome.php");
    }
} else {
    header("Location: ../view/welcome.php");
    exit();
}
?>
