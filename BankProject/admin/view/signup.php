<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="../css/mystyle.css">
</head>
<body>
    <div class="container">
        <h1>Create an Account</h1>
        <form action="../control/reg_control.php" method="POST" enctype="multipart/form-data">
            <!-- Full Name -->
            <div class="form-group">
                <label for="full_name">Full Name:</label>
                <input type="text" id="full_name" name="full_name" required placeholder="Enter your full name">
            </div>
            
            <!-- Email -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required placeholder="Enter your email address">
            </div>

            <!-- Phone Number -->
            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="text" id="phone_number" name="phone_number" required placeholder="Enter your phone number">
            </div>

            <!-- Branch -->
            <div class="form-group">
                <label for="branch">Branch:</label>
                <input type="text" id="branch" name="branch" required placeholder="Enter your branch">
            </div>

            <!-- Date of Birth -->
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" required>
            </div>

            <!-- Username -->
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required placeholder="Enter your username">
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required placeholder="Enter your password">
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required placeholder="Confirm your password">
            </div>

            <!-- Role -->
            <div class="form-group">
                <label for="role">Role:</label>
                <select id="role" name="role" required>
                    <option value="">Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>

            <!-- ID Proof Upload -->
            <div class="form-group">
                <label for="id_proof">Upload ID Proof:</label>
                <input type="file" id="id_proof" name="id_proof" required>
            </div>

            <!-- Form Buttons -->
            <div class="form-buttons">
                <button type="submit">Register</button>
                <a href="login.php">Already have an account? Login here.</a>
            </div>
        </form>
    </div>
</body>
</html>
