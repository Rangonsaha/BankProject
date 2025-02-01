<?php
// Start the session
session_start();

// Include the database connection function
include_once '../model/db.php';

// Check if the customer is logged in
if (!isset($_SESSION['CustomerId'])) {
    echo "You need to be logged in to request a loan.";
    exit;
}

// Retrieve the CustomerId from the session
$customerId = $_SESSION['CustomerId'];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $amount = $_POST['Amount'];
    $loanTerm = $_POST['LoanTerm'];

    // Validate the input data
    if (empty($amount) || empty($loanTerm)) {
        echo "All fields are required!";
        exit;
    }

    if (!is_numeric($amount) || !is_numeric($loanTerm)) {
        echo "Loan amount and term must be numeric!";
        exit;
    }

    // Connect to the database
    try {
        $conn = connectDB();

        // Prepare the SQL query to insert the loan request
        $sql = "INSERT INTO loan (CustomerId, Amount, LoanTerm, Status) 
                VALUES (:CustomerId, :Amount, :LoanTerm, 'Pending')"; // Default status is 'Pending'

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind the parameters
        $stmt->bindParam(':CustomerId', $customerId);
        $stmt->bindParam(':Amount', $amount);
        $stmt->bindParam(':LoanTerm', $loanTerm);

        // Execute the query
        if ($stmt->execute()) {
            echo "Loan request submitted successfully!";
        } else {
            // If query execution fails, show the error message
            echo "Error submitting loan request: " . implode(", ", $stmt->errorInfo());
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    $conn = null;
}
?>
