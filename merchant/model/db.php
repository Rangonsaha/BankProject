<?php
function openCon() {
    $DBHost = "localhost";
    $DBuser = "root";
    $DBpassword = "";
    $DBname = "bankmanagementsystem"; 
    
    $connectionObject = new mysqli($DBHost, $DBuser, $DBpassword, $DBname);

    if ($connectionObject->connect_error) {
        die("Connection failed: " . $connectionObject->connect_error);
    }

    return $connectionObject;
}

function insertMerchant($conn, $merchant_data) {
    $query = "INSERT INTO merchant (BusinessName, Email, Name, Password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $merchant_data['business_name'], $merchant_data['email'], $merchant_data['merchant_name'], $merchant_data['password']);
    return $stmt->execute();
}

function emailExists($conn, $email) {
    $query = "SELECT * FROM merchant WHERE Email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    return $stmt->num_rows > 0;
}

function getMerchantByEmail($conn, $email) {
    $query = "SELECT * FROM merchant WHERE Email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function getAllMerchants($conn) {
    $query = "SELECT * FROM merchant";
    return $conn->query($query)->fetch_all(MYSQLI_ASSOC);
}

function updatePassword($conn, $email, $new_password) {
    $query = "UPDATE merchant SET Password = ? WHERE Email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $new_password, $email);
    return $stmt->execute();
}

function getMerchantById($conn, $merchantId) {
    $query = "SELECT * FROM merchant WHERE MerchantId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $merchantId);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function updateMerchantDetails($conn, $merchant_id, $name, $email, $business_name, $password) {
    $query = "UPDATE merchant SET Name = ?, Email = ?, BusinessName = ?, Password = ? WHERE MerchantId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssi", $name, $email, $business_name, $password, $merchant_id);
    return $stmt->execute();
}

function getPendingLoans($conn) {
    $query = "SELECT * FROM loan WHERE Status = 'Pending'";
    return $conn->query($query)->fetch_all(MYSQLI_ASSOC);
}

function approveLoan($conn, $loanId) {
    $query = "UPDATE loan SET Status = 'Approved' WHERE LoanId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $loanId);
    return $stmt->execute();
}

function declineLoan($conn, $loanId) {
    $query = "UPDATE loan SET Status = 'Declined' WHERE LoanId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $loanId);
    return $stmt->execute();
}

function getCustomerNameById($conn, $customerId) {
    $query = "SELECT Name FROM customer WHERE CustomerId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $customerId);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc()['Name'] ?? 'Unknown';
}

function updateBankAccountBalance($conn, $customerId, $loanAmount) {
    $query = "UPDATE bankaccount SET Balance = Balance + ? WHERE CustomerId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("di", $loanAmount, $customerId);
    return $stmt->execute();
}

function getLoanDetailsById($conn, $loanId) {
    $query = "SELECT * FROM loan WHERE LoanId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $loanId);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function updateLoanStatus($conn, $loanId, $status) {
    $query = "UPDATE loan SET Status = ? WHERE LoanId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $loanId);
    return $stmt->execute();
}

function getCustomers($conn) {
    $query = "SELECT CustomerId, Name, Email, Phone FROM customer";
    return $conn->query($query)->fetch_all(MYSQLI_ASSOC);
}

function getAllFeedback($conn) {
    $query = "SELECT * FROM feedback ORDER BY CreatedAt DESC";
    return $conn->query($query)->fetch_all(MYSQLI_ASSOC);
}

function getCustomerDetails($conn, $customerId) {
    $query = "SELECT Name, Email, Phone FROM customer WHERE CustomerId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $customerId);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function getCustomersD($conn) {
    $query = "SELECT CustomerId, Name FROM customer";
    return $conn->query($query)->fetch_all(MYSQLI_ASSOC);
}

function closeConnection($conn) {
    $conn->close();
}
?>

