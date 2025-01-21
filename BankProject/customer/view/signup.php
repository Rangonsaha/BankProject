<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <p> <title>Customer Sign-Up Form</title></p>
    <link rel="stylesheet" href="../css/mystyle.css">
</head>
<body>
    <form action="../control/reg_control.php" method="post">
        <center>
            <fieldset>
               <p>Customer Sign-Up</p>
                <table>
                    <tr>
                        <td><label id ="fullName">Full Name:</label></td>
                        <td>
                            <input type="text" name="fullName" placeholder="First Name">
                            <input type="text" name="lastName" placeholder="Last Name">
                        </td>
                    </tr>
                    <tr>
                        <td><label for="dob">Date of Birth:</label></td>
                        <td><input type="date" name="dob" required></td>
                    </tr>
                    <tr>
                        <td><label for="gender">Gender:</label></td>
                        <td>
                            <input type="radio" name="gender" value="Male"> Male
                            <input type="radio" name="gender" value="Female"> Female
                        </td>
                    </tr>
                    <tr>
                        <td><label for="email">Email:</label></td>
                        <td><input type="text" name="email" placeholder="ex: abc@gmail.com"></td>
                    </tr>
                    <tr>
                        <td><label for="phone">Phone Number:</label></td>
                        <td><input type="text" name="phone" placeholder="Enter your phone number"></td>
                    </tr>
                    <tr>
                        <td><label for="NID">NID:</label></td>
                        <td><input type="text" name="NID" placeholder="Enter your NID"></td>
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
        </center>
    </form>
</body>
</html>
