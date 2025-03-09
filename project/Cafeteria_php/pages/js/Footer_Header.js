// -------------------------------drop down----------------//


document.addEventListener("DOMContentLoaded", function () {
    let dropdowns = document.querySelectorAll(".dropdown");

    dropdowns.forEach(function (dropdown) {
        let dropdownToggle = dropdown.querySelector(".dropdown-toggle");
        let dropdownMenu = dropdown.querySelector(".dropdown-menu");

        let bsDropdown = new bootstrap.Dropdown(dropdownToggle); 

        dropdown.addEventListener("mouseenter", function () {
            dropdownToggle.classList.add("show");
            dropdownMenu.classList.add("show");
            dropdownMenu.style.display = "block"; 
        });

        dropdown.addEventListener("mouseleave", function () {
            dropdownToggle.classList.remove("show");
            dropdownMenu.classList.remove("show");
            dropdownMenu.style.display = "none";
        });
    });
});


  
