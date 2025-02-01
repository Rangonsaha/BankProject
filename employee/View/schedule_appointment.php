<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Appointment</title>
    <link rel="stylesheet" href="../CSS/mystyle.css">
    <link rel="stylesheet" href="../CSS/schedule_appointment.css">
</head>
<body>

<?php include 'header.php'; ?>

<center>
    <h2>Schedule Appointment</h2>

    <form method="POST" action="../control/schedule_appointment_control.php">
        <label for="customer_id">Customer ID:</label>
        <input type="number" name="customer_id" placeholder="Customer ID" >

        <label for="employee_id">Employee ID:</label>
        <input type="number" name="employee_id" placeholder="Employee ID" >

        <label for="appointment_date">Appointment Date:</label>
        <input type="date" name="appointment_date" >
        <br>
        <label for="service_type">Service Type:</label>
        <select name="service_type" >
            <option value="Loan Consultation">Loan Consultation</option>
            <option value="Account Assistance">Account Assistance</option>
            <option value="General Inquiry">General Inquiry</option>
        </select>
        <label for="appointment_time">Appointment Time:</label>
        <input type="time" name="appointment_time" >
        <br>
        <br>
        
        <button type="submit" name="schedule_appointment">Schedule Appointment</button>
    </form>

    <br>
    <a href="employee_dashboard.php" class="back-btn">Back to Dashboard</a>
</center>

<?php include 'footer.php'; ?>

</body>
</html>
