<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Feedback</title>
    <link rel="stylesheet" href="../css/feedback.css">
</head>
<body>
<?php include 'header.php'; ?>

    <div class="feedback-container">
        <h2>Submit Your Feedback</h2>

        <form action="../control/feedback_control.php" method="POST">
            <input type="hidden" name="CustomerId" value="<?php echo $_SESSION['CustomerId']; ?>">

            <label for="rating">Rating (1-5):</label>
            <select name="rating" id="rating">
                <option value="1">1 - Poor</option>
                <option value="2">2 - Fair</option>
                <option value="3">3 - Good</option>
                <option value="4">4 - Very Good</option>
                <option value="5">5 - Excellent</option>
            </select>

            <label for="message">Feedback:</label>
            <textarea name="message" id="message" rows="5"></textarea>

            <button type="submit" name="submit_feedback">Submit Feedback</button>
        </form>
    </div>

    <?php include 'footer.php'; ?>

</body>
</html>
