<?php
class myDB {
    // Open connection to the bankmanagementsystem database
    function openCon() {
        $DBHost = "localhost";
        $DBuser = "root";
        $DBpassword = "";
        $DBname = "bankmanagementsystem";

        $connectionObject = new mysqli($DBHost, $DBuser, $DBpassword, $DBname);

        // Check connection
        if ($connectionObject->connect_error) {
            die("Connection failed: " . $connectionObject->connect_error);
        }

        return $connectionObject;
    }

    // Insert data into the merchant table
    function insertMerchantData($merchantData, $connectionObject) {
        $sql = "INSERT INTO merchant (
                    merchant_name, 
                    email, 
                    password, 
                    business_name, 
                ) VALUES (?, ?, ?, ?)";

        $stmt = $connectionObject->prepare($sql);

        if (!$stmt) {
            echo "SQL prepare error: " . $connectionObject->error . "<br>";
            return;
        }

        // Loop through the JSON data and insert each entry
        foreach ($merchantData as $merchant) {
            // Bind parameters from JSON data to SQL query
            $stmt->bind_param(
                "ssss", 
                $merchant['merchant_name'], 
                $merchant['email'], 
                $merchant['password'], 
                $merchant['business_name'], 
            );

            if (!$stmt->execute()) {
                echo "Error executing query for " . $merchant['email'] . ": " . $stmt->error . "<br>";
            } else {
                echo "Data inserted successfully for: " . $merchant['email'] . "<br>";
            }
        }

        $stmt->close();
    }

    function getUsers($connectionObject, $table) {
       $sql="SELECT * FROM $table";
       return $connectionObject->query($sql);

    }




    // Close connection
    function closeCon($connectionObject) {
        $connectionObject->close();
    }
}

// // Read and decode the JSON file
// $jsonFile = 'data/userdata.json'; // Adjust the path if necessary
// if (file_exists($jsonFile)) {
//     $jsonData = file_get_contents($jsonFile);
//     $merchantData = json_decode($jsonData, true); // Decode JSON into an associative array

//     if ($merchantData === null) {
//         echo "Error decoding JSON: " . json_last_error_msg();
//     } else {
//         echo "JSON file decoded successfully.<br>";

//         // Create a new database connection
//         $db = new myDB();
//         $connection = $db->openCon();

//         // Insert the merchant data into the database
//         $db->insertMerchantData($merchantData, $connection);

//         // Close the connection
//         $db->closeCon($connection);
//     }
// } else {
//     echo "JSON file does not exist.";
// }
?>
