<?php

// Database connection function
function connectDB()
{
    $host = 'localhost'; // Replace with your database host
    $user = 'root'; // Replace with your MySQL username
    $password = ''; // Replace with your MySQL password
    $database = 'bankmanagementsystem'; // Replace with your database name

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}

// Fetch a user by email from the database
function getUserByEmail($email)
{
    $pdo = connectDB();
    $query = "SELECT * FROM customer WHERE Email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['email' => $email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Add a new user to the database
function addCustomer($customer)
{
    try {
        $conn = connectDB();

        // Hash password before storing in the database
        $hashedPassword = password_hash($customer['Password'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO customer (Email, Name, Password, Phone) VALUES (:Email, :Name, :Password, :Phone)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':Email', $customer['Email']);
        $stmt->bindParam(':Name', $customer['Name']);
        $stmt->bindParam(':Password', $hashedPassword);  // Use the hashed password
        $stmt->bindParam(':Phone', $customer['Phone']);

        return $stmt->execute();
    } catch (PDOException $e) {
        echo "<p style='color:red;'>Database error: " . $e->getMessage() . "</p>";
        return false;
    }
}
?>
