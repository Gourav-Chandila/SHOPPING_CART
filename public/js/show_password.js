// Get references to password fields and toggle buttons
const togglePassword = document.querySelectorAll(".toggle-password");
const passwords = document.querySelectorAll(".password-input");

// Add event listener to each toggle button
togglePassword.forEach(function(button, index) {
    button.addEventListener("click", function () {
        // Toggle the type attribute of the corresponding password field
        const type = passwords[index].getAttribute("type") === "password" ? "text" : "password";
        passwords[index].setAttribute("type", type);

        // Toggle the icon class for the clicked button
        this.classList.toggle("bi-eye");
    });
});

// Prevent form submission for demonstration purpose
// const form = document.querySelector("form");
// form.addEventListener('submit', function (e) {
//     e.preventDefault();
// });
