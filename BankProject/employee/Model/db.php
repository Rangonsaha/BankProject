<?php
class myDB {
  
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

  
    function insertemployeeData($employeeData, $connectionObject) {
      
        $sql = "INSERT INTO employee (Name, Email, Password, Gender) VALUES (?, ?, ?, ?)";

  
        $stmt = $connectionObject->prepare($sql);

        if (!$stmt) {
            echo "SQL prepare error: " . $connectionObject->error . "<br>";
            return;
        }

    
        foreach ($employeeData as $employee) {
           
            $name = $employee['firstName'] . ' ' . $employee['lastName'];
            
           
            $stmt->bind_param(
                "ssss", 
                $name, 
                $employee['email'], 
                $employee['password'], 
                $employee['gender']
            );

            if (!$stmt->execute()) {
                echo "Error executing query for " . $employee['email'] . ": " . $stmt->error . "<br>";
            } else {
                echo "Data inserted successfully for: " . $employee['email'] . "<br>";
            }
        }

      
        $stmt->close();
    }

  
    function closeCon($connectionObject) {
        $connectionObject->close();
    }
}
?>
