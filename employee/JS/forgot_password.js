// validation.js

// Function to validate email input
function validateForgotPasswordForm() {
    var email = document.getElementById("email").value;
    var errorMessage = "";

    // Check if email field is empty
    if (email == "") {
        errorMessage = "Email field cannot be empty!";
    }
    // Check if the email format is valid
    else if (!validateEmail(email)) {
        errorMessage = "Please enter a valid email address!";
    }

    if (errorMessage) {
        // Display error message
        document.getElementById("error-message").innerText = errorMessage;
        return false; // Prevent form submission
    }

    return true; // Allow form submission
}

// Function to validate email format
function validateEmail(email) {
    var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    return emailPattern.test(email);
}
