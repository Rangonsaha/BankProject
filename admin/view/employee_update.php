<?php
session_start();


if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

require_once '../model/db.php';


$employeeId = isset($_GET['id']) ? $_GET['id'] : '';

if ($employeeId) {
    $db = new myDB();
    $connection = $db->openCon();

    
    $stmt = $connection->prepare("SELECT * FROM employee WHERE Name = ?");
    $stmt->bind_param("s", $employeeId);
    $stmt->execute();
    $result = $stmt->get_result();
    $employeeData = $result->fetch_assoc();

    $stmt->close();
    $db->closeCon($connection);

    if (!$employeeData) {
        header("Location: welcome.php");
        exit();
    }
} else {
    header("Location: welcome.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/mystyle.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee</title>
</head>
<body>
<?php include 'header.php'; ?>
    <h1>Update Employee Data</h1>

    
    <?php if (isset($_SESSION['success'])): ?>
        <p class="success-message"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
    <?php elseif (isset($_SESSION['error'])): ?>
        <p class="error-message"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>

   
    <form action="../control/employee_update_control.php" method="POST">
        <input type="hidden" name="employee_id" value="<?php echo $employeeData['Name']; ?>">

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $employeeData['Name']; ?>">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo $employeeData['Email']; ?>">
        </div>

        <div class="form-group">
            <label for="gender">Gender:</label>
            <input type="text" id="gender" name="gender" value="<?php echo $employeeData['Gender']; ?>">
        </div>

        <button type="submit">Update Employee</button>
    </form>

    
    <form action="../control/employee_delete_control.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this employee?');">
        <input type="hidden" name="employee_id" value="<?php echo $employeeData['Name']; ?>">
        <button type="submit" class="delete-button">Delete Employee</button>
    </form>

    <br><br>
    <a href="welcome.php">Back to Welcome Page</a>
    <?php include 'footer.php'; ?>
</body>
</html>
