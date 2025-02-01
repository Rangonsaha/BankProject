<?php
// Database credentials
$host = 'localhost';  // Replace with your database host if different
$dbname = 'bankmanagementsystem';
$username = 'root';   // Replace with your database username
$password = '';       // Replace with your database password

// Create a PDO connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Function to insert merchant data
function insertMerchant($merchant_data) {
    global $pdo;

    // Prepare SQL query to insert the merchant data into the database
    $query = "INSERT INTO merchant (BusinessName, Email, Name, Password) 
              VALUES (:business_name, :email, :merchant_name, :password)";
    
    $stmt = $pdo->prepare($query);

    // Bind the data to the query
    $stmt->bindParam(':business_name', $merchant_data['business_name']);
    $stmt->bindParam(':email', $merchant_data['email']);
    $stmt->bindParam(':merchant_name', $merchant_data['merchant_name']);
    $stmt->bindParam(':password', $merchant_data['password']); // Store the password in plain text

    // Execute the query and return success/failure
    return $stmt->execute();
}

// Function to check if email already exists
function emailExists($email) {
    global $pdo;

    $query = "SELECT * FROM merchant WHERE Email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // If a record is found, return true (email exists)
    return $stmt->rowCount() > 0;
}

// Function to fetch merchant data by email (for login)
function getMerchantByEmail($email) {
    global $pdo; // Use $pdo instead of $db

    try {
        $stmt = $pdo->prepare("SELECT * FROM merchant WHERE Email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return null; // No merchant found
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}

// Function to fetch all merchants (Optional for validation or other purposes)
function getAllMerchants() {
    global $pdo;

    $query = "SELECT * FROM merchant";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    
    // Return all fetched rows
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to update merchant password (in case of forgot password or admin update)
function updatePassword($email, $new_password) {
    global $pdo;

    // Prepare SQL query to update password
    $query = "UPDATE merchant SET Password = :password WHERE Email = :email";
    $stmt = $pdo->prepare($query);

    // Bind the new password and email to the query
    $stmt->bindParam(':password', $new_password);
    $stmt->bindParam(':email', $email);

    // Execute the query and return success/failure
    return $stmt->execute();
}

// Function to fetch merchant data by MerchantId (for profile view)
function getMerchantById($merchantId) {
    global $pdo; // Use $pdo instead of $db

    // Debugging: Check if $merchantId is set
    if (!$merchantId) {
        echo "Merchant ID is not set!";
        exit(); // Stop execution if the ID is not set
    }

    try {
        // Query to fetch merchant details based on MerchantId
        $stmt = $pdo->prepare("SELECT * FROM merchant WHERE MerchantId = ?");
        $stmt->execute([$merchantId]);

        // Debugging: Check if any row is found
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            echo "No merchant found for MerchantId: $merchantId";
            return null; // No data found for the given MerchantId
        }
    } catch (Exception $e) {
        // Log the error
        echo "Database error: " . $e->getMessage();
        return null; // Return null if there's an error
    }
}

// Function to update merchant profile details
function updateMerchantDetails($merchant_id, $name, $email, $business_name, $password) {
    global $pdo;

    // Update SQL query
    $query = "UPDATE merchant SET Name = :name, Email = :email, BusinessName = :business_name, Password = :password WHERE MerchantId = :merchant_id";
    $stmt = $pdo->prepare($query);

    // Bind the data to the query
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':business_name', $business_name);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':merchant_id', $merchant_id);

    // Execute the query and return success/failure
    return $stmt->execute();
}

// Function to fetch all pending loans
function getPendingLoans() {
    global $pdo;

    $query = "SELECT * FROM loan WHERE Status = 'Pending'";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// Function to approve a loan
function approveLoan($loanId) {
    global $pdo;

    $query = "UPDATE loan SET Status = 'Approved' WHERE LoanId = :loanId";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':loanId', $loanId);

    return $stmt->execute();
}

// Function to decline a loan
function declineLoan($loanId) {
    global $pdo;

    // Prepare the query to update the loan status to 'Declined'
    $query = "UPDATE loan SET Status = 'Declined' WHERE LoanId = :loanId";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':loanId', $loanId, PDO::PARAM_INT);

    // Execute and return success/failure
    return $stmt->execute();
}

// Function to get customer name by CustomerId
function getCustomerNameById($customerId) {
    global $pdo;

    $query = "SELECT Name FROM customer WHERE CustomerId = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$customerId]);

    $customer = $stmt->fetch(PDO::FETCH_ASSOC);
    return $customer ? $customer['Name'] : 'Unknown';
}

// Function to update the bank account balance
function updateBankAccountBalance($customerId, $loanAmount) {
    global $pdo;

    // SQL query to update the bank account balance
    $query = "UPDATE bankaccount SET Balance = Balance + :loanAmount WHERE CustomerId = :customerId";
    
    // Prepare the statement
    $stmt = $pdo->prepare($query);
    
    // Bind the parameters
    $stmt->bindParam(':loanAmount', $loanAmount, PDO::PARAM_STR);
    $stmt->bindParam(':customerId', $customerId, PDO::PARAM_INT);
    
    // Execute the query and return success/failure
    return $stmt->execute();
}

function getLoanDetailsById($loanId) {
    global $pdo;

    $query = "SELECT * FROM loan WHERE LoanId = :loanId";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':loanId', $loanId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);  // Return loan details
}

// Function to update loan status
function updateLoanStatus($loanId, $status) {
    global $pdo;

    $query = "UPDATE loan SET Status = :status WHERE LoanId = :loanId";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
    $stmt->bindParam(':loanId', $loanId, PDO::PARAM_INT);

    return $stmt->execute();  // Return success/failure
}

// Function to fetch all customers from the database
function getCustomers() {
    global $pdo;

    $query = "SELECT CustomerId, Name, Email, Phone FROM customer"; // Exclude password for security
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAllFeedback() {
    global $pdo;
    
    try {
        $query = "SELECT * FROM feedback ORDER BY CreatedAt DESC";
        $stmt = $pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error fetching feedback: " . $e->getMessage());
    }
}

// Function to fetch customer details by ID
function getCustomerDetails($customerId) {
    global $pdo;
    $sql = "SELECT Name, Email, Phone FROM customer WHERE CustomerId = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$customerId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Function to fetch all customers
function getCustomersD() {
    global $pdo;
    $sql = "SELECT CustomerId, Name FROM customer";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// Optional: Function to close the database connection (not always necessary with PDO)
function closeConnection() {
    global $pdo;
    $pdo = null; // Close connection
}
?>
