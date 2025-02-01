<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchant Sign-Up - Bank Management System</title>
    <link rel="stylesheet" href="../css/mystyle.css">
</head>
<body>
    <form id="signupForm" method="POST" action="../control/reg_control.php">
        <fieldset>
            <legend>Merchant Sign-Up</legend>

            <label for="merchant_name">Full Name:</label>
            <input type="text" name="merchant_name" id="merchant_name">
            <small class="error-message" id="merchant_name_error"></small><br><br>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email">
            <small class="error-message" id="email_error"></small><br><br>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
            <small class="error-message" id="password_error"></small><br><br>

            <label for="business_name">Business Name:</label>
            <input type="text" name="business_name" id="business_name">
            <small class="error-message" id="business_name_error"></small><br><br>

            <label for="business_reg_number">Business Registration Number:</label>
            <input type="text" name="business_reg_number" id="business_reg_number">
            <small class="error-message" id="business_reg_number_error"></small><br><br>

            <label for="business_type">Business Type:</label>
            <input type="text" name="business_type" id="business_type">
            <small class="error-message" id="business_type_error"></small><br><br>

            <label for="business_address">Business Address:</label>
            <textarea name="business_address" id="business_address"></textarea>
            <small class="error-message" id="business_address_error"></small><br><br>

            <label for="contact_number">Contact Number:</label>
            <input type="text" name="contact_number" id="contact_number">
            <small class="error-message" id="contact_number_error"></small><br><br>

            <label for="business_website">Business Website (if any):</label>
            <input type="url" name="business_website" id="business_website">
            <small class="error-message" id="business_website_error"></small><br><br>

            <label for="payment_method">Preferred Payment Method:</label>
            <select name="payment_method" id="payment_method">
                <option value="">Select a payment method</option>
                <option value="Bank Transfer">Bank Transfer</option>
                <option value="PayPal">PayPal</option>
                <option value="Credit Card">Credit Card</option>
                <option value="Other">Other</option>
            </select>
            <small class="error-message" id="payment_method_error"></small><br><br>

            <input type="submit" class="signUpbutton" value="Sign Up"><br><br>

            <p>Already have an account? <a href="login.php">Login</a></p>
        </fieldset>
    </form>

    <script src="../js/signup_validation.js"></script>
</body>
</html>
