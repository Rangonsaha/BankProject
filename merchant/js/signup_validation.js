document.getElementById("signupForm").addEventListener("submit", function(event) {
    let isValid = true;

    // Helper function to set error messages
    function setError(id, message) {
        document.getElementById(id).innerHTML = message;
        isValid = false;
    }

    function clearError(id) {
        document.getElementById(id).innerHTML = "";
    }

    // Full Name Validation
    let merchantName = document.getElementById("merchant_name").value.trim();
    if (merchantName.length < 4) {
        setError("merchant_name_error", "Full Name must be at least 4 characters.");
    } else {
        clearError("merchant_name_error");
    }

    // Email Validation (Must be @student.aiub.edu)
    let email = document.getElementById("email").value.trim();
    let emailPattern = /^[a-zA-Z0-9._%+-]+@student\.aiub\.edu$/;
    if (!emailPattern.test(email)) {
        setError("email_error", "Email must be a valid AIUB student email.");
    } else {
        clearError("email_error");
    }

    // Password Validation
    let password = document.getElementById("password").value.trim();
    if (password.length < 6) {
        setError("password_error", "Password must be at least 6 characters long.");
    } else {
        clearError("password_error");
    }

    // Business Name Validation
    let businessName = document.getElementById("business_name").value.trim();
    if (businessName === "") {
        setError("business_name_error", "Business Name is required.");
    } else {
        clearError("business_name_error");
    }

    // Business Registration Number Validation
    let businessRegNumber = document.getElementById("business_reg_number").value.trim();
    if (businessRegNumber === "") {
        setError("business_reg_number_error", "Business Registration Number is required.");
    } else {
        clearError("business_reg_number_error");
    }

    // Business Type Validation
    let businessType = document.getElementById("business_type").value.trim();
    if (businessType === "") {
        setError("business_type_error", "Business Type is required.");
    } else {
        clearError("business_type_error");
    }

    // Business Address Validation
    let businessAddress = document.getElementById("business_address").value.trim();
    if (businessAddress === "") {
        setError("business_address_error", "Business Address is required.");
    } else {
        clearError("business_address_error");
    }

    // Contact Number Validation (Only Numbers)
    let contactNumber = document.getElementById("contact_number").value.trim();
    if (!/^\d+$/.test(contactNumber)) {
        setError("contact_number_error", "Contact Number must contain only numbers.");
    } else {
        clearError("contact_number_error");
    }

    // Business Website Validation (if provided)
    let businessWebsite = document.getElementById("business_website").value.trim();
    if (businessWebsite !== "" && !/^https?:\/\/.+\..+/.test(businessWebsite)) {
        setError("business_website_error", "Business Website must be a valid URL.");
    } else {
        clearError("business_website_error");
    }

    // Payment Method Validation
    let paymentMethod = document.getElementById("payment_method").value;
    if (paymentMethod === "") {
        setError("payment_method_error", "Please select a payment method.");
    } else {
        clearError("payment_method_error");
    }

    // Prevent form submission if validation fails
    if (!isValid) {
        event.preventDefault();
    }
});
