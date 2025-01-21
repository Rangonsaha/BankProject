document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");

    form.addEventListener("submit", (event) => {
        let errors = [];

        // Full Name Validation (at least 4 characters)
        const merchantName = document.getElementById("merchant_name").value.trim();
        if (merchantName.length < 4) {
            errors.push("Full Name must be at least 4 characters long.");
        }

        // Email Validation (must be a valid aiub.edu email)
        const email = document.getElementById("email").value.trim();
        const emailRegex = /^[a-zA-Z0-9._%+-]+@aiub\.edu$/;
        if (!emailRegex.test(email)) {
            errors.push("Email must be a valid aiub.edu email address.");
        }

        // Password Validation (at least 6 characters)
        const password = document.getElementById("password").value.trim();
        if (password.length < 6) {
            errors.push("Password must be at least 6 characters long.");
        }

        // Business Name Validation (required)
        const businessName = document.getElementById("business_name").value.trim();
        if (businessName === "") {
            errors.push("Business Name is required.");
        }

        // Business Registration Number Validation (required)
        const businessRegNumber = document.getElementById("business_reg_number").value.trim();
        if (businessRegNumber === "") {
            errors.push("Business Registration Number is required.");
        }

        // Business Type Validation (required)
        const businessType = document.getElementById("business_type").value.trim();
        if (businessType === "") {
            errors.push("Business Type is required.");
        }

        // Business Address Validation (required)
        const businessAddress = document.getElementById("business_address").value.trim();
        if (businessAddress === "") {
            errors.push("Business Address is required.");
        }

        // Contact Number Validation (must contain only numbers)
        const contactNumber = document.getElementById("contact_number").value.trim();
        if (!/^\d+$/.test(contactNumber)) {
            errors.push("Contact Number must contain only numbers.");
        }

        // Business Website Validation (optional, must be a valid URL if provided)
        const businessWebsite = document.getElementById("business_website").value.trim();
        if (businessWebsite !== "" && !isValidURL(businessWebsite)) {
            errors.push("Business Website must be a valid URL.");
        }

        // Payment Method Validation (required)
        const paymentMethod = document.getElementById("payment_method").value;
        if (paymentMethod === "") {
            errors.push("Please select a payment method.");
        }

        // Display errors or allow submission
        if (errors.length > 0) {
            event.preventDefault(); // Prevent form submission
            showErrors(errors);
        }
    });

    // Utility function to validate URL
    function isValidURL(string) {
        try {
            new URL(string);
            return true;
        } catch (_) {
            return false;
        }
    }

    // Utility function to display errors
    function showErrors(errors) {
        const errorContainer = document.getElementById("errorMessages");
        if (!errorContainer) {
            const container = document.createElement("div");
            container.id = "errorMessages";
            container.style.color = "red";
            form.insertBefore(container, form.firstChild);
        }
        const errorMessages = errors.map((error) => `<p>${error}</p>`).join("");
        document.getElementById("errorMessages").innerHTML = errorMessages;
    }
});
