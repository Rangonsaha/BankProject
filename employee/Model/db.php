<?php
class myDB {

    // Method to open a connection to the database
    function openCon() {
        $DBHost = "localhost";
        $DBuser = "root";
        $DBpassword = "";
        $DBname = "bankmanagementsystem"; 
        
        $connectionObject = new mysqli($DBHost, $DBuser, $DBpassword, $DBname);

        if ($connectionObject->connect_error) {
            die("Connection failed: " . $connectionObject->connect_error);
        }

        return $connectionObject;
    }

    // Method to open a new account
    function openAccount($customer_name, $customer_email, $account_type, $connectionObject) {
        $sql = "INSERT INTO accounts (customer_name, customer_email, account_type, balance) VALUES (?, ?, ?, 0)";

        $stmt = $connectionObject->prepare($sql);
        $stmt->bind_param("sss", $customer_name, $customer_email, $account_type);

        if (!$stmt->execute()) {
            return "Error opening account: " . $stmt->error;
        }
        return "New account opened successfully!";
    }

    // Method to close an account
    function closeAccount($account_id, $connectionObject) {
        $sql = "DELETE FROM accounts WHERE account_id = ?";

        $stmt = $connectionObject->prepare($sql);
        $stmt->bind_param("i", $account_id);

        if (!$stmt->execute()) {
            return "Error closing account: " . $stmt->error;
        }
        return "Account closed successfully!";
    }

    // Method to update account type
    function updateAccountType($account_id, $new_account_type, $connectionObject) {
        $sql = "UPDATE accounts SET account_type = ? WHERE account_id = ?";

        $stmt = $connectionObject->prepare($sql);
        $stmt->bind_param("si", $new_account_type, $account_id);

        if (!$stmt->execute()) {
            return "Error updating account: " . $stmt->error;
        }
        return "Account updated successfully!";
    }

    // Method to deposit money into an account
    function depositMoney($account_id, $deposit_amount, $connectionObject) {
        $sql = "UPDATE accounts SET balance = balance + ? WHERE account_id = ?";

        $stmt = $connectionObject->prepare($sql);
        $stmt->bind_param("di", $deposit_amount, $account_id);

        if (!$stmt->execute()) {
            return "Error depositing money: " . $stmt->error;
        }
        return "Deposit successful!";
    }

    // Method to withdraw money from an account
    function withdrawMoney($account_id, $withdraw_amount, $connectionObject) {
        $sql = "SELECT balance FROM accounts WHERE account_id = ?";
        $stmt = $connectionObject->prepare($sql);
        $stmt->bind_param("i", $account_id);
        $stmt->execute();
        $stmt->bind_result($balance);
        $stmt->fetch();
        $stmt->close();

        if ($withdraw_amount > $balance) {
            return "Insufficient balance!";
        }

        $sql = "UPDATE accounts SET balance = balance - ? WHERE account_id = ?";
        $stmt = $connectionObject->prepare($sql);
        $stmt->bind_param("di", $withdraw_amount, $account_id);

        if (!$stmt->execute()) {
            return "Error withdrawing money: " . $stmt->error;
        }
        return "Withdrawal successful!";
    }

    // Method to transfer money between accounts
    function transferMoney($sender_account_id, $receiver_account_id, $transfer_amount, $connectionObject) {
        // Check if sender has enough balance
        $sql = "SELECT balance FROM accounts WHERE account_id = ?";
        $stmt = $connectionObject->prepare($sql);
        $stmt->bind_param("i", $sender_account_id);
        $stmt->execute();
        $stmt->bind_result($sender_balance);
        $stmt->fetch();
        $stmt->close();

        if ($transfer_amount > $sender_balance) {
            return "Insufficient balance in sender's account!";
        }

        // Deduct from sender's account
        $sql = "UPDATE accounts SET balance = balance - ? WHERE account_id = ?";
        $stmt = $connectionObject->prepare($sql);
        $stmt->bind_param("di", $transfer_amount, $sender_account_id);
        $stmt->execute();

        // Add to receiver's account
        $sql = "UPDATE accounts SET balance = balance + ? WHERE account_id = ?";
        $stmt = $connectionObject->prepare($sql);
        $stmt->bind_param("di", $transfer_amount, $receiver_account_id);
        $stmt->execute();

        return "Transfer successful!";
    }

    // Method to apply for a loan
    function applyForLoan($customer_id, $loan_amount, $loan_term, $loan_type, $connectionObject) {
        $sql = "INSERT INTO loans (customer_id, loan_amount, loan_term, loan_type, loan_status) VALUES (?, ?, ?, ?, 'Pending')";

        $stmt = $connectionObject->prepare($sql);
        $stmt->bind_param("idss", $customer_id, $loan_amount, $loan_term, $loan_type);

        if (!$stmt->execute()) {
            return "Error applying for loan: " . $stmt->error;
        }
        return "Loan application submitted successfully!";
    }


    // Method to approve the loan
    function approveLoan($loan_id, $connectionObject) {
        $sql = "UPDATE loans SET loan_status = 'Approved' WHERE loan_id = ?";

        $stmt = $connectionObject->prepare($sql);
        $stmt->bind_param("i", $loan_id);

        if (!$stmt->execute()) {
            return "Error approving loan: " . $stmt->error;
        }
        return "Loan approved successfully!";
    }

    // Method to reject the loan
    function rejectLoan($loan_id, $connectionObject) {
        $sql = "UPDATE loans SET loan_status = 'Rejected' WHERE loan_id = ?";

        $stmt = $connectionObject->prepare($sql);
        $stmt->bind_param("i", $loan_id);

        if (!$stmt->execute()) {
            return "Error rejecting loan: " . $stmt->error;
        }
        return "Loan rejected successfully!";
    }
 // Method to schedule an appointment
 function scheduleAppointment($customer_id, $employee_id, $appointment_date, $appointment_time, $service_type, $connectionObject) {
    $sql = "INSERT INTO appointments (customer_id, employee_id, appointment_date, appointment_time, service_type) 
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $connectionObject->prepare($sql);
    $stmt->bind_param("iisss", $customer_id, $employee_id, $appointment_date, $appointment_time, $service_type);

    if (!$stmt->execute()) {
        return false;
    }
    return true;
}
public function emailExists($email) {
    $conn = $this->openCon();
    $query = "SELECT * FROM employee WHERE Email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Return true if email exists, false otherwise
    return $result->num_rows > 0;
}




    // Method to close the database connection
    function closeCon($connectionObject) {
        $connectionObject->close();
    }
}
?>
