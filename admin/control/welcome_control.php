<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../view/login.php");
    exit();
}

require_once '../model/db.php'; 

class WelcomeController {
    private $db;

    public function __construct() {
        $this->db = new myDB(); 
    }

    public function index() {
        
        $admins = $this->db->getAdmins();
        $merchants = $this->db->getMerchants();
        $employees = $this->db->getEmployees();

        
        require_once '../view/welcome.php';
    }
}


$controller = new WelcomeController();
$controller->index();
?>
