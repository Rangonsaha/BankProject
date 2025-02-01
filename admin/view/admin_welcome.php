<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="../css/mystyle.css"> 
</head>

<body>
<?php include 'header.php'; ?>
   
    

    
    <center>
        <div class="image-container">
            <img src="bank.png" alt="Bank Image" class="bank-img" height="300" width="300">
        </div>

        <div class="main-content">
            <div class="text-content">
                <h1>Bank on Better Lending</h1>
                <h3>With our new online application service, applying for a consumer loan or credit card is even easier!</h3>
                <h2>Begin your journey with us today and experience effortless banking with our seamless online services.</h2>

                
                <form method="POST" action="../view/login.php">
                    <button type="submit" name="login" class="button">Login Here!</button>
                </form>

                <p class="black">Don't have an account? <a href="signup.php">Sign up here</a></p>
            </div>
        </div>
    </center>
    <br>

    
    <?php include 'footer.php'; ?>
</body>

</html>
