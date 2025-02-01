<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Signup</title>
    <link rel="stylesheet" href="../CSS/mystyle.css"> 
    
</head>
<body>
<?php include 'header.php'; ?>
<script src="../JS/Employee_signup_validation.js" ></script>

    <center>
        <h2><strong>Employee Signup</strong></h2>
        <form action="../control/reg_control.php" method="post" onsubmit="validateForm(event)">

            <fieldset>
                     <strong>Signup Information</strong>
               <table class=m>
                    <tr>
                        <td class="black"><label for="firstName">Full Name:</label></td>
                        <td><input type="text" id="firstName" name="firstName" placeholder="First Name" ></td>
                        <td><input type="text" id="lastName" name="lastName" placeholder="Last Name"></td>
                    </tr>
                    <tr>
                        <td><span id="nameError"></span></td>
                    </tr>
                    <tr>
                        <td class="black"><label for="dob">Date of Birth:</label></td>
                        <td><input type="date" id="dob" name="dob" ></td>
                    </tr>
                    <tr>
                        <td><span id="dobError" ></span></td>
                    </tr>
                    <tr>
                        <td class="black"><label for="email">Email:</label></td>
                        <td><input type="email" id="email" name="email" placeholder="example@gmail.com" ></td>
                    </tr>
                    <tr>
                        <td ><span id="emailError" ></span></td>
                    </tr>
                    <tr>
                        <td class="black"><label for="phone">Phone Number:</label></td>
                        <td><input type="tel" id="phone" name="phone" placeholder="Your phone number" ></td>
                    </tr>
                    <tr>
                        <td><span id="phoneError" ></span></td>
                    </tr>
                    <tr>
                        <td class="black"><label for="nid">NID:</label></td>
                        <td><input type="text" id="nid" name="nid" placeholder="Your NID" ></td>
                    </tr>
                    <tr>
                         <td><span id="nidError" ></span></td>
                    </tr>
                    <tr>
                        <td class="black"><label for="address">Street Address:</label></td>
                        <td><input type="text" id="address" name="address"placeholder="Your address" ></td>
                    </tr>
                    <tr>
                        <td><span id="addressError" ></span></td>
                    </tr>
                    <tr>
                        <td class="black"><label for="city">City:</label></td>
                        <td><input type="text" id="city" name="city"placeholder="Your city" ></td>
                    </tr>
                    <tr>
                        <td><span id="cityError"></span></td>
                    </tr>
                    <tr>
                        <td class="black"><label for="gender">Gender:</label></td>
                        <td>
                            <input type="radio" id="male" name="gender" value="male" >
                            <label for="male">Male</label>
                            <input type="radio" id="female" name="gender" value="female">
                            <label for="female">Female</label>
                        </td>
                    </tr>
                    <tr>
                        <td><span id="genderError"></span></td>
                    </tr>
                    <tr>
                        <td class="black"><label for="password">Password:</label></td>
                        <td><input type="password" id="password" name="password" ></td>
                    </tr>
                    <tr>
                    <td ><span id="passwordError"></span></td>
                    </tr>
                    <tr>
                        <td class="black"><label for="confirmPassword">Confirm Password:</label></td>
                        <td><input type="password" id="confirmPassword" name="confirmPassword" ></td>
                    </tr>
                    <tr>
                        <td><span id="confirmPasswordError" ></span></td>
                    </tr>
                 </table>
                    <button type="submit"><strong>Sign Up</strong></button>
            </fieldset>
        </form>
        <p  class="black">Already have an account? <a href="login.php">Login here</a></p>
    </center>
    <?php include 'footer.php'; ?>
    
</body>
</html>
