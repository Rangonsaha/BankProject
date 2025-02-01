<?php
session_start();
require_once('../control/manage_feedback_control.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Feedback</title>
    <link rel="stylesheet" href="../css/manage_feedback.css">
</head>
<body>

    <?php include('header.php'); ?>

    <div class="manage-feedback-container">
        <h2>Customer Feedback</h2>

        <?php if (count($feedbacks) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Feedback ID</th>
                        <th>Customer ID</th>
                        <th>Message</th>
                        <th>Rating</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($feedbacks as $feedback): ?>
                        <tr>
                            <td data-label="Feedback ID"><?php echo $feedback['FeedbackId']; ?></td>
                            <td data-label="Customer ID"><?php echo $feedback['CustomerId']; ?></td>
                            <td data-label="Message"><?php echo htmlspecialchars($feedback['Message']); ?></td>
                            <td data-label="Rating"><?php echo str_repeat("⭐", $feedback['Rating']); ?></td>
                            <td data-label="Date"><?php echo $feedback['CreatedAt']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No feedback available.</p>
        <?php endif; ?>
    </div>

    <?php include('footer.php'); ?>

</body>
</html>
