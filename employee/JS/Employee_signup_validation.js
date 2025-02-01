function validateName() {
    const firstName = document.getElementById('firstName').value.trim();
    const lastName = document.getElementById('lastName').value.trim();
    const nameError = document.getElementById('nameError');

    if (firstName === '' || lastName === '') {
        nameError.innerHTML = 'First and Last Name are required.';
        return false;
    }
    nameError.innerHTML = '';
    return true;
}

function validateDOB() {
    const dob = document.getElementById('dob').value;
    const dobError = document.getElementById('dobError');

    if (!dob) {
        dobError.innerHTML = 'Please select a valid date of birth.';
        return false;
    }
    dobError.innerHTML = '';
    return true;
}

function validateEmail() {
    const email = document.getElementById('email').value.trim();
    const emailError = document.getElementById('emailError');
    const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if (!regex.test(email)) {
        emailError.innerHTML = 'Please enter a valid email address (e.g., example@gmail.com).';
        return false;
    }
    emailError.innerHTML = '';
    return true;
}

function validatePhone() {
    const phone = document.getElementById('phone').value.trim();
    const phoneError = document.getElementById('phoneError');
    const regex = /^[0-9]{10,15}$/;

    if (!regex.test(phone)) {
        phoneError.innerHTML = 'Phone number must be 10-15 digits long.';
        return false;
    }
    phoneError.innerHTML = '';
    return true;
}

function validateNID() {
    const nid = document.getElementById('nid').value.trim();
    const nidError = document.getElementById('nidError');

    if (nid.length !== 10 || isNaN(nid)) {
        nidError.innerHTML = 'NID must be exactly 10 digits long.';
        return false;
    }
    nidError.innerHTML = '';
    return true;
}

function validateAddress() {
    const address = document.getElementById('address').value.trim();
    const addressError = document.getElementById('addressError');

    if (address === '') {
        addressError.innerHTML = 'Street address is required.';
        return false;
    }
    addressError.innerHTML = '';
    return true;
}

function validateCity() {
    const city = document.getElementById('city').value.trim();
    const cityError = document.getElementById('cityError');

    if (city === '') {
        cityError.innerHTML = 'City is required.';
        return false;
    }
    cityError.innerHTML = '';
    return true;
}

function validateGender() {
    const male = document.getElementById('male').checked;
    const female = document.getElementById('female').checked;
    const genderError = document.getElementById('genderError');

    if (!male && !female) {
        genderError.innerHTML = 'Please select a gender.';
        return false;
    }
    genderError.innerHTML = '';
    return true;
}

function validatePassword() {
    const password = document.getElementById('password').value.trim();
    const passwordError = document.getElementById('passwordError');
    const regex = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;

    if (!regex.test(password)) {
        passwordError.innerHTML = 'Password must be at least 8 characters long, include one uppercase letter, one number, and one special character.';
        return false;
    }
    passwordError.innerHTML = '';
    return true;
}

function validateConfirmPassword() {
    const password = document.getElementById('password').value.trim();
    const confirmPassword = document.getElementById('confirmPassword').value.trim();
    const confirmPasswordError = document.getElementById('confirmPasswordError');

    if (password !== confirmPassword) {
        confirmPasswordError.innerHTML = 'Passwords do not match. Please try again.';
        return false;
    }
    confirmPasswordError.innerHTML = '';
    return true;
}

function validateForm(event) {
    const isNameValid = validateName();
    const isDOBValid = validateDOB();
    const isEmailValid = validateEmail();
    const isPhoneValid = validatePhone();
    const isNIDValid = validateNID();
    const isAddressValid = validateAddress();
    const isCityValid = validateCity();
    const isGenderValid = validateGender();
    const isPasswordValid = validatePassword();
    const isConfirmPasswordValid = validateConfirmPassword();

    if (!isNameValid || !isDOBValid || !isEmailValid || !isPhoneValid || !isNIDValid || !isAddressValid || !isCityValid || !isGenderValid || !isPasswordValid || !isConfirmPasswordValid) {
        event.preventDefault();
    }
}
