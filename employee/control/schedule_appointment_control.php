<?php 
// Include the database connection
include '../model/db.php';

// Initialize error messages
$errors = [];

// Check if the form is submitted
if (isset($_POST['schedule_appointment'])) {
    // Get the form data
    $customer_id = $_POST['customer_id'];
    $employee_id = $_POST['employee_id'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $service_type = $_POST['service_type'];

    // Validate Customer ID (must be a positive integer)
    if (empty($customer_id) || !is_numeric($customer_id) || $customer_id <= 0) {
        $errors[] = "Customer ID must be a valid positive number.";
    }

    // Validate Employee ID (must be a positive integer)
    if (empty($employee_id) || !is_numeric($employee_id) || $employee_id <= 0) {
        $errors[] = "Employee ID must be a valid positive number.";
    }

    // Validate Appointment Date (must be in the future)
    if (empty($appointment_date)) {
        $errors[] = "Appointment date is required.";
    } elseif (strtotime($appointment_date) < time()) {
        $errors[] = "Appointment date must be in the future.";
    }

    // Validate Appointment Time
    if (empty($appointment_time)) {
        $errors[] = "Appointment time is required.";
    }

    // Validate Service Type (must be selected)
    if (empty($service_type)) {
        $errors[] = "Please select a service type.";
    }

    // If there are validation errors, display them and stop the process
    if (!empty($errors)) {
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>" . $error . "</li>";
        }
        echo "</ul>";
        exit;
    }

    // Create an instance of the myDB class
    $db = new myDB();
    $connection = $db->openCon();

    // Call the method to schedule the appointment
    $result = $db->scheduleAppointment($customer_id, $employee_id, $appointment_date, $appointment_time, $service_type, $connection);

    // Check if the appointment was successfully scheduled
    if ($result) {
        // Redirect to a success page or display a success message
        echo "<p>Appointment scheduled successfully!</p>";
        echo "<a href='../view/employee_dashboard.php'>Back to Dashboard</a>";
    } else {
        // Handle error if appointment was not scheduled
        echo "<p>Failed to schedule appointment. Please try again later.</p>";
        echo "<a href='../view/schedule_appointment.php'>Try Again</a>";
    }

    // Close the database connection
    $db->closeCon($connection);
}
?>

