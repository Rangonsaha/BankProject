<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Sign-Up Form</title>
    <link rel="stylesheet" href="../css/mystyle.css">
</head>
<body>
    <form action="../control/reg_control.php" method="post" class="signup-form">
        <center>
            <fieldset>
                <legend>Customer Sign-Up</legend>
                <table>
                    <tr>
                        <td><label for="fullName">Full Name:</label></td>
                        <td>
                            <input type="text" name="fullName" placeholder="First Name" required>
                            <input type="text" name="lastName" placeholder="Last Name" required>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="dob">Date of Birth:</label></td>
                        <td><input type="date" name="dob" required></td>
                    </tr>
                    <tr>
                        <td><label for="gender">Gender:</label></td>
                        <td>
                            <input type="radio" name="gender" value="Male" required> Male
                            <input type="radio" name="gender" value="Female" required> Female
                        </td>
                    </tr>
                    <tr>
                        <td><label for="email">Email:</label></td>
                        <td><input type="email" name="email" placeholder="ex: abc@gmail.com" required></td>
                    </tr>
                    <tr>
                        <td><label for="phone">Phone Number:</label></td>
                        <td><input type="text" name="phone" placeholder="Enter your phone number" required></td>
                    </tr>
                    <tr>
                        <td><label for="NID">NID:</label></td>
                        <td><input type="text" name="NID" placeholder="Enter your NID" required></td>
                    </tr>
                    <tr>
                        <td><label for="address">Street Address:</label></td>
                        <td><input type="text" name="address" required></td>
                    </tr>
                    <tr>
                        <td><label for="city">City:</label></td>
                        <td><input type="text" name="city" required></td>
                    </tr>
                    <tr>
                        <td><label for="state">State:</label></td>
                        <td><input type="text" name="state" required></td>
                    </tr>
                    <tr>
                        <td><label for="zip">ZIP Code:</label></td>
                        <td><input type="text" name="zip" required></td>
                    </tr>
                    <tr>
                        <td><label for="password">Password:</label></td>
                        <td><input type="password" name="password" required></td>
                    </tr>
                    <tr>
                        <td><label for="confirmPassword">Confirm Password:</label></td>
                        <td><input type="password" name="confirmPassword" required></td>
                    </tr>
                </table>
            </fieldset>
        </center>
        <center>
            <button type="submit" class="button">Sign Up</button>
            <p class="login-link">
                Already have an account? <a href="login.php">Login here</a>
            </p>
        </center>
    </form>
</body>
</html>
