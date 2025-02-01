<?php
require_once '../model/db.php';

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action == 'getCustomers') {
        $customers = getCustomersd();
        echo json_encode($customers);
    } elseif ($action == 'getCustomerDetails' && isset($_GET['CustomerId'])) {
        $customerId = $_GET['CustomerId'];
        $customerDetails = getCustomerDetails($customerId);
        echo json_encode($customerDetails);
    }
}

closeConnection();
?>
