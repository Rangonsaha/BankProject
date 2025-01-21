<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchant Sign-Up - Bank Management System</title>
    <link rel="stylesheet" href="../css/mystyle.css">
</head>
<body>
<form method="POST" action="../control/reg_control.php">
    <table align="center">
        <tr>
            <td>
                <div>
                    <fieldset>
                        <legend>Merchant Sign-Up</legend>

                        <label for="merchant_name">Full Name:</label>
                        <input type="text" name="merchant_name" id="merchant_name" required><br><br>

                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" required><br><br>

                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" required><br><br>

                        <label for="business_name">Business Name:</label>
                        <input type="text" name="business_name" id="business_name" required><br><br>

                        <label for="business_reg_number">Business Registration Number:</label>
                        <input type="text" name="business_reg_number" id="business_reg_number" required><br><br>

                        <label for="business_type">Business Type:</label>
                        <input type="text" name="business_type" id="business_type" required><br><br>

                        <label for="business_address">Business Address:</label>
                        <textarea name="business_address" id="business_address" rows="3" required></textarea><br><br>

                        <label for="contact_number">Contact Number:</label>
                        <input type="text" name="contact_number" id="contact_number" required><br><br>

                        <label for="business_website">Business Website (if any):</label>
                        <input type="website" name="business_website" id="business_website"><br><br>

                        <label for="payment_method">Preferred Payment Method:</label>
                        <select name="payment_method" id="payment_method" >
                            <option value="">Select a payment method</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="PayPal">PayPal</option>
                            <option value="Credit Card">Credit Card</option>
                            <option value="Other">Other</option>
                        </select><br><br>

                        <input type="submit" class="signUpbutton" value="Sign Up">
                    </fieldset>
                </div>
            </td>
        </tr>
    </table>
</form>
<script src="../js/reg_validation.js"></script>
</body>
</html>
