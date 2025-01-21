<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <header class="header">
        <div class="logo">
            <h1>Customer Portal</h1>
        </div>
        <nav class="nav">
            <ul>
                <li><a href="#account">Account</a></li>
                <li><a href="#payments">Bill Payments</a></li>
                <li><a href="#transfers">Funds Transfer</a></li>
                <li><a href="#loans">Loans</a></li>
                <li><a href="#profile">Profile</a></li>
                <li><a href="#logout">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main class="main">
        <section id="account" class="section">
            <h2>Account Overview</h2>
            <div class="card-container">
                <div class="card">
                    <h3>Account Balance</h3>
                    <p>$5,200</p>
                </div>
                <div class="card">
                    <h3>Recent Transactions</h3>
                    <ul>
                        <li>Payment to Electric Bill - $200</li>
                        <li>Transfer to Savings - $500</li>
                        <li>ATM Withdrawal - $100</li>
                    </ul>
                </div>
            </div>
        </section>
        <section id="payments" class="section">
            <h2>Bill Payments</h2>
            <p>Pay your utility bills, credit card bills, and more.</p>
            <button>Pay Bills</button>
        </section>
        <section id="transfers" class="section">
            <h2>Funds Transfer</h2>
            <p>Transfer funds between your accounts or to others.</p>
            <button>Transfer Funds</button>
        </section>
        <section id="loans" class="section">
            <h2>Loans</h2>
            <p>Manage your loans and check eligibility.</p>
            <button>Manage Loans</button>
        </section>
    </main>
    <footer class="footer">
        <p>&copy; 2025 Customer Portal. All rights reserved.</p>
    </footer>
</body>
</html>
