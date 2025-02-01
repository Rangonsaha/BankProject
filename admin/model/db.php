<?php

class myDB {
    private $connectionObject;

    
    public function openCon() {
        $DBHost = "localhost";
        $DBUser = "root";
        $DBPassword = "";
        $DBName = "bankmanagementsystem";

       
        $this->connectionObject = new mysqli($DBHost, $DBUser, $DBPassword, $DBName);

       
        if ($this->connectionObject->connect_error) {
            die("Connection failed: " . $this->connectionObject->connect_error);
        }

        return $this->connectionObject;
    }

    
    public function getAdmins() {
        $connectionObject = $this->openCon();

        
        $stmt = $connectionObject->prepare("SELECT * FROM admin");
        if (!$stmt) {
            die("Error preparing statement: " . $connectionObject->error);
        }

        
        $stmt->execute();
        $result = $stmt->get_result();

       
        $stmt->close();
        $this->closeCon($connectionObject);

        return $result; 
    }

   
    public function insertData($table, $columns, $values) {
        $connectionObject = $this->openCon();

     
        $placeholders = implode(", ", array_fill(0, count($values), "?"));
        $columnsString = implode(", ", $columns);

        $stmt = $connectionObject->prepare("INSERT INTO $table ($columnsString) VALUES ($placeholders)");
        if (!$stmt) {
            die("Error preparing statement: " . $connectionObject->error);
        }

       
        $types = str_repeat("s", count($values)); 
        $stmt->bind_param($types, ...$values);

        
        if ($stmt->execute()) {
            $result = true;
        } else {
            $result = "Error: " . $stmt->error;
        }

        
        $stmt->close();
        $this->closeCon($connectionObject);

        return $result; 
    }

    
    public function getMerchants() {
        $connection = $this->openCon();
        $query = "SELECT Name, Email, BusinessName FROM merchant"; 
        $result = $connection->query($query);
        return $result;
    }

    
    public function getEmployees() {
        $connection = $this->openCon();
        $query = "SELECT Name, Email, Gender FROM employee"; 
        $result = $connection->query($query);
        return $result;
    }

    
    public function insertAdminData($full_name, $username, $email, $password, $phone_number, $role, $employee_id, $address, $security_question, $profile_picture, $default_language, $time_zone) {
        return $this->insertData(
            'admin',
            ['full_name', 'username', 'email', 'password', 'phone_number', 'role', 'employee_id', 'address', 'security_question', 'default_language', 'time_zone'],
            [$full_name, $username, $email, $password, $phone_number, $role, $employee_id, $address, $security_question, $default_language, $time_zone]
        );
    }

    
    public function getTransactions() {
        $connectionObject = $this->openCon();

        
        $stmt = $connectionObject->prepare("SELECT * FROM transaction");
        if (!$stmt) {
            die("Error preparing statement: " . $connectionObject->error);
        }

        
        $stmt->execute();
        $result = $stmt->get_result();

        
        $stmt->close();
        $this->closeCon($connectionObject);

        return $result; 
    }

    
    public function insertTransaction($accountId, $amount, $transactionType, $date, $initiatedBy) {
        return $this->insertData(
            'transaction',
            ['AccountId', 'Amount', 'TransactionType', 'Date', 'InitiatedBy'],
            [$accountId, $amount, $transactionType, $date, $initiatedBy]
        );
    }

    
    public function closeCon($connectionObject) {
        $connectionObject->close();
    }
}
?>
