document.addEventListener("DOMContentLoaded", function () {
    fetchCustomers();
});

function fetchCustomers() {
    fetch("../control/customer_details_control.php?action=getCustomers")
        .then(response => response.json())
        .then(data => {
            let customerSelect = document.getElementById("customerSelect");
            data.forEach(customer => {
                let option = document.createElement("option");
                option.value = customer.CustomerId;
                option.textContent = customer.Name;
                customerSelect.appendChild(option);
            });
        })
        .catch(error => console.error("Error fetching customers:", error));
}

function fetchCustomerDetails() {
    let customerId = document.getElementById("customerSelect").value;
    if (!customerId) return;

    fetch(`../control/customer_details_control.php?action=getCustomerDetails&CustomerId=${customerId}`)
        .then(response => response.json())
        .then(customer => {
            document.getElementById("customerName").textContent = customer.Name;
            document.getElementById("customerEmail").textContent = customer.Email;
            document.getElementById("customerPhone").textContent = customer.Phone;
        })
        .catch(error => console.error("Error fetching customer details:", error));
}
