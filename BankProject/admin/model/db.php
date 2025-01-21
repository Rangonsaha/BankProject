<?php

class myDB {
    private $connectionObject;

    // Open connection to the database
    public function openCon() {
        $DBHost = "localhost";
        $DBUser = "root";
        $DBPassword = "";
        $DBName = "bankmanagementsystem";

        // Create connection
        $this->connectionObject = new mysqli($DBHost, $DBUser, $DBPassword, $DBName);

        // Check connection
        if ($this->connectionObject->connect_error) {
            die("Connection failed: " . $this->connectionObject->connect_error);
        }

        return $this->connectionObject;
    }

    // Fetch all admin data from the admin table
    public function getAdmins() {
        $connectionObject = $this->openCon();

        // Prepare query to fetch all admins
        $stmt = $connectionObject->prepare("SELECT * FROM admin");
        if (!$stmt) {
            die("Error preparing statement: " . $connectionObject->error);
        }

        // Execute query and fetch result
        $stmt->execute();
        $result = $stmt->get_result();

        // Close the prepared statement and connection
        $stmt->close();
        $this->closeCon($connectionObject);

        return $result; // Return the result set
    }

    // Insert data into the specified table
    public function insertData($table, $columns, $values) {
        $connectionObject = $this->openCon();

        // Dynamically build placeholders for prepared statements
        $placeholders = implode(", ", array_fill(0, count($values), "?"));
        $columnsString = implode(", ", $columns);

        // Prepare query to insert data
        $stmt = $connectionObject->prepare("INSERT INTO $table ($columnsString) VALUES ($placeholders)");
        if (!$stmt) {
            die("Error preparing statement: " . $connectionObject->error);
        }

        // Dynamically bind parameters
        $types = str_repeat("s", count($values)); // Assuming all inputs are strings
        $stmt->bind_param($types, ...$values);

        // Execute and check if insertion is successful
        if ($stmt->execute()) {
            $result = true;
        } else {
            $result = "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        $this->closeCon($connectionObject);

        return $result; // Return the result status
    }

    // Close the database connection
    public function closeCon($connectionObject) {
        $connectionObject->close();
    }
}
?>
