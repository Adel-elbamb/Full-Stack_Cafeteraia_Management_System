document.addEventListener("DOMContentLoaded", function() {
    let rows = document.querySelectorAll("tbody tr");

    rows.forEach(row => {
        row.addEventListener("click", function() {
            let orderId = this.querySelector("input[name='order_id']").value; 

            fetch(`get_order_details.php?order_id=${orderId}`)
                .then(response => response.text())
                .then(data => {
                    let detailsDiv = document.getElementById("orderDetails");
                    detailsDiv.innerHTML = data; 
                    detailsDiv.style.display = "block"; 
                })
                .catch(error => console.error("Error fetching details:", error));
        });
    });
});