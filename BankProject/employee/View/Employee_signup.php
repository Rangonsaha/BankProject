<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Signup</title>
    <link rel="stylesheet" href="../CSS/mystyle.css"> 
</head>
<body>

    <center>
        <h2><strong>Employee Signup</strong></h2>
        <form action="../Control/reg_control.php" method="post">
            <fieldset>
                     <strong>Signup Information</strong>
               <table class=m>
                    <tr>
                        <td class="black"><label for="firstName">Full Name:</label></td>
                        <td><input type="text" id="firstName" name="firstName" placeholder="First Name" required></td>
                        <td><input type="text" id="lastName" name="lastName" placeholder="Last Name" required></td>
                    </tr>
                    <tr>
                        <td class="black"><label for="dob">Date of Birth:</label></td>
                        <td><input type="date" id="dob" name="dob" required></td>
                    </tr>
                    <tr>
                        <td class="black"><label for="email">Email:</label></td>
                        <td><input type="email" id="email" name="email" placeholder="example@gmail.com" required></td>
                    </tr>
                    <tr>
                        <td class="black"><label for="phone">Phone Number:</label></td>
                        <td><input type="tel" id="phone" name="phone" placeholder="Your phone number" required></td>
                    </tr>
                    <tr>
                        <td class="black"><label for="nid">NID:</label></td>
                        <td><input type="text" id="nid" name="nid" placeholder="Your NID" required></td>
                    </tr>
                    <tr>
                        <td class="black"><label for="address">Street Address:</label></td>
                        <td><input type="text" id="address" name="address"placeholder="Your address" required></td>
                    </tr>
                    <tr>
                        <td class="black"><label for="city">City:</label></td>
                        <td><input type="text" id="city" name="city"placeholder="Your city" required></td>
                    </tr>
                    <tr>
                        <td class="black"><label for="gender">Gender:</label></td>
                        <td>
                            <input type="radio" id="male" name="gender" value="male" required>
                            <label for="male">Male</label>
                            <input type="radio" id="female" name="gender" value="female">
                            <label for="female">Female</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="black"><label for="password">Password:</label></td>
                        <td><input type="password" id="password" name="password" required></td>
                    </tr>
                    <tr>
                        <td class="black"><label for="confirmPassword">Confirm Password:</label></td>
                        <td><input type="password" id="confirmPassword" name="confirmPassword" required></td>
                    </tr>
                 </table>
                    <button type="submit"><strong>Sign Up</strong></button>
            </fieldset>
        </form>
        <p  class="black">Already have an account? <a href="login.php">Login here</a></p>
    </center>
</body>
</html>
