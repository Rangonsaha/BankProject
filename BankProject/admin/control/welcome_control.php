<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../view/login.php");
    exit();
}

require_once '../model/db.php'; // Include the model class

class WelcomeController {
    private $db;

    public function __construct() {
        $this->db = new myDB(); // Initialize the database object
    }

    public function index() {
        // Get all admins from the database
        $admins = $this->db->getAdmins();

        // Pass the data to the view (welcome view)
        require_once '../view/welcome.php';
    }
}

// Instantiate the controller and call the index method
$controller = new WelcomeController();
$controller->index();
?>
