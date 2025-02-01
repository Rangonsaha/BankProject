<?php
require_once('../model/db.php'); // Database connection


if (!isset($_SESSION['merchant_id'])) {
    echo "Error: Merchant not logged in.";
    exit;
}

$feedbacks = getAllFeedback();
?>
