// Validate Email
function validateEmail() {
    const email = document.getElementById('email').value.trim();
    const emailError = document.getElementById('emailError');
    const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if (!regex.test(email)) {
        emailError.innerHTML = 'Please enter a valid email address (e.g., example@gmail.com).';
        emailError.style.color = "red";
        return false;
    }
    emailError.innerHTML = '';  // Clear any previous error
    return true;
}

// Validate Password
function validatePassword() {
    const password = document.getElementById('password').value.trim();
    const passwordError = document.getElementById('passwordError');

    if (password.length < 8) {
        passwordError.innerHTML = 'Password must be at least 8 characters long.';
        passwordError.style.color = "red";
        return false;
    }
    passwordError.innerHTML = '';  // Clear any previous error
    return true;
}

// Validate Form
function validateForm(event) {
    const isEmailValid = validateEmail();
    const isPasswordValid = validatePassword();

    // If any validation fails, prevent form submission
    if (!isEmailValid || !isPasswordValid) {
        event.preventDefault();
    }
}
