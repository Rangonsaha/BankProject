document.getElementById("login-form").addEventListener("submit", function(event) {
    let isValid = true;

    // Helper function to set error messages
    function setError(id, message) {
        document.getElementById(id).innerHTML = message;
        isValid = false; // Set isValid to false when there's an error
    }

    function clearError(id) {
        document.getElementById(id).innerHTML = "";
    }

    // Email Validation
    let email = document.getElementById("email").value.trim();
    if (email === "") {
        setError("email-error", "Email is required.");
    } else if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/.test(email)) {
        setError("email-error", "Invalid email format.");
    } else {
        clearError("email-error");
    }

    // Password Validation
    let password = document.getElementById("password").value.trim();
    if (password === "") {
        setError("password-error", "Password is required.");
    } else if (password.length < 6) {
        setError("password-error", "Password must be at least 6 characters long.");
    } else {
        clearError("password-error");
    }

    // If validation fails, prevent the form submission
    if (!isValid) {
        event.preventDefault();  // Prevent form submission
    }
});
