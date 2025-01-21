<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
 {
    $errors = [];
    $formData = []; 

    
    if (isset($_POST['firstName'], $_POST['lastName']) && 
        preg_match("/^[a-zA-Z]+$/", $_POST['firstName']) && 
        preg_match("/^[a-zA-Z]+$/", $_POST['lastName'])) {
        $formData['firstName'] = $_POST['firstName'];
        $formData['lastName'] = $_POST['lastName'];
    } else {
        $errors[] = "Full Name must contain only letters.";
    }

  
    if (isset($_POST['dob']) && !empty($_POST['dob'])) {
        $dob = $_POST['dob'];
        if ($dob > date("Y-m-d")) {
            $errors[] = "Date of Birth cannot be in the future.";
        } else {
            $formData['dob'] = $dob;
        }
    } else {
        $errors[] = "Date of Birth is required.";
    }

 
    if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && str_ends_with($_POST['email'], ".com")) {
        $formData['email'] = $_POST['email'];
    } else {
        $errors[] = "Email must be valid and end with '.com'.";
    }

    
    if (isset($_POST['phone']) && preg_match("/^\d{10,12}$/", $_POST['phone'])) {
        $formData['phone'] = $_POST['phone'];
    } else {
        $errors[] = "Phone Number must be between 10 and 12 digits.";
    }

    
    if (isset($_POST['nid']) && preg_match("/^\d{6,20}$/", $_POST['nid'])) {
        $formData['nid'] = $_POST['nid'];
    } else {
        $errors[] = "NID must contain only numbers and be between 6 and 20 digits.";
    }

 
    if (isset($_POST['gender']) && ($_POST['gender'] == "male" || $_POST['gender'] == "female")) {
        $formData['gender'] = $_POST['gender'];
    } else {
        $errors[] = "Gender is required.";
    }

   
    if (isset($_POST['password']) && preg_match("/[0-9]/", $_POST['password'])) {
        $formData['password'] = $_POST['password']; 
    } else {
        $errors[] = "Password must contain at least one number.";
    }

    if (isset($_POST['confirmPassword']) && $_POST['confirmPassword'] === $_POST['password']) {
        $formData['confirmPassword'] = $_POST['confirmPassword'];
    } else {
        $errors[] = "Passwords do not match.";
    }

    if ($errors) {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    } else {
        
        $data_dir = __DIR__ . '/../data';
        $file_path = $data_dir . '/userdata.json';

        if (!is_dir($data_dir)) {
            mkdir($data_dir, 0777, true);
        }

        $user_data = [
            'firstName' => $formData['firstName'],
            'lastName' => $formData['lastName'],
            'dob' => $formData['dob'],
            'email' => $formData['email'],
            'phone' => $formData['phone'],
            'nid' => $formData['nid'],
            'address' => $_POST['address'] ?? '',
            'city' => $_POST['city'] ?? '',
            'gender' => $formData['gender'],
            'password' => $formData['password']
        ];

        $existing_data = [];
        if (file_exists($file_path)) {
            $json_data = file_get_contents($file_path);
            $existing_data = json_decode($json_data, true) ?? [];
        }

        $existing_data[] = $user_data;

        if (file_put_contents($file_path, json_encode($existing_data, JSON_PRETTY_PRINT))) {
            echo "<p>User data successfully saved to userdata.json.</p>";
        } else {
            echo "<p>Error: Unable to save user data.</p>";
        }
    }
}
?>
