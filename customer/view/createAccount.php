<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Bank Account</title>
    <link rel="stylesheet" href="../css/createAccount.css">
</head>
<body>

    <div class="container">
        <h2>Create Bank Account</h2>
        <form action="../control/createAccountControl.php" method="POST">
            <div class="form-group">
                <label for="accountType">Account Type:</label>
                <select name="accountType" id="accountType">
                    <option value="">Select Account Type</option>
                    <option value="Savings">Savings</option>
                    <option value="Checking">Checking</option>
                    <option value="Business">Business</option>
                </select>
            </div>
            <div class="form-group">
                <label for="balance">Initial Balance:</label>
                <input type="number" name="balance" id="balance" value="0" min="0">
            </div>
            <button type="submit" class="button">Create Account</button>
        </form>
    </div>

</body>
</html>