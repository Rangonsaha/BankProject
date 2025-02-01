<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Processing</title>
    <link rel="stylesheet" href="../CSS/mystyle.css">
    <link rel="stylesheet" href="../CSS/loan_processing.css">

</head>
<body>

<?php include 'header.php'; ?>

<center>
    <h2>Loan Processing</h2>

    <!-- Apply for Loan -->
    <form method="POST" action="../control/loan_processing_control.php">
        <h3>Apply for Loan</h3>
        <input type="number" name="customer_id" placeholder="Customer ID" >
        <input type="number" name="loan_amount" placeholder="Loan Amount" >
        <input type="text" name="loan_term" placeholder="Loan Term" >
        <select name="loan_type">
            <option value="Personal">Personal</option>
            <option value="Home">Home</option>
            <option value="Car">Car</option>
        </select>
        <button type="submit" name="apply_loan">Apply for Loan</button>
    </form>



    <hr>

    <!-- Approve Loan -->
    <form method="POST" action="../control/loan_processing_control.php">
        <h3>Approve Loan</h3>
        <input type="number" name="loan_id" placeholder="Loan ID" >
        <button type="submit" name="approve_loan">Approve Loan</button>
    </form>

    <hr>

    <!-- Reject Loan -->
    <form method="POST" action="../control/loan_processing_control.php">
        <h3>Reject Loan</h3>
        <input type="number" name="loan_id" placeholder="Loan ID" >
        <button type="submit" name="reject_loan">Reject Loan</button>
    </form>

   

    <br>
    <a href="employee_dashboard.php" class="back-btn">Back to Dashboard</a>
</center>

<?php include 'footer.php'; ?>

</body>
</html>
