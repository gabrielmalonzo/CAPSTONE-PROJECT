var hidePassword = 1; // Initialize hidePassword variable

function password() {
    var passwordInput = document.getElementById('password');
    var passIcon = document.getElementById('pass-icon');

    if (hidePassword == 1) {
        passwordInput.type = 'text'; // Change input type to text to show password
        passIcon.src = 'pass-show.png'; // Change icon to indicate password is visible
        hidePassword = 0; // Update hidePassword state
    } else {
        passwordInput.type = 'password'; // Change input type back to password to hide password
        passIcon.src = 'pass-hide.png'; // Change icon to indicate password is hidden
        hidePassword = 1; // Update hidePassword state
    }
}

function togglePasswordVisibility(inputId) {
    var input = document.getElementById(inputId);
    var passIcon = document.getElementById('pass-icon-' + inputId);

    if (input.type === "password") {
        input.type = "text";
        passIcon.src = "./Image/see.png"; // Change to the icon that indicates the password is visible
    } else {
        input.type = "password";
        passIcon.src = "./Image/unsee.png"; // Change to the icon that indicates the password is hidden
    }
}

// Function to set the active link
function setActiveLink() {
    const links = document.querySelectorAll('.navbar a');
    const currentPath = window.location.pathname;

    links.forEach(link => {
        if (link.href.includes(currentPath)) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });
}

// Call the function to set the active link when the page loads
document.addEventListener('DOMContentLoaded', setActiveLink);

