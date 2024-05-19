// Get the date of birth input element
var dobInput = document.getElementById('dob');

// Set the maximum date to today to restrict selecting future dates
dobInput.max = new Date().toISOString().split("T")[0];

// Function to validate if the user is at least 18 years old
function validateAge() {
    var dob = new Date(dobInput.value);
    var today = new Date();
    var age = today.getFullYear() - dob.getFullYear();
    var monthDiff = today.getMonth() - dob.getMonth();
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
        age--;
    }
    return age >= 18;
}

document.addEventListener('DOMContentLoaded', function() {
    // Get all input elements with the class "input"
    const inputs = document.querySelectorAll('.input');

    // Loop through each input element
    inputs.forEach(input => {
        const placeholder = input.previousElementSibling; // Get the previous sibling, which is the placeholder label

        // Add input event listener to each input element
        input.addEventListener('input', function() {
            if (input.value.trim() !== '') {
                placeholder.classList.add('active');
            } else {
                placeholder.classList.remove('active');
            }
        });

        // Add focus event listener to each input element
        input.addEventListener('focus', function() {
            placeholder.classList.add('active');
        });

        // Add blur event listener to each input element
        input.addEventListener('blur', function() {
            if (input.value.trim() === '') {
                placeholder.classList.remove('active');
            }
        });

        // Check if input has value on page load
        if (input.value.trim() !== '') {
            placeholder.classList.add('active');
        } else {
            placeholder.classList.remove('active');
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Get all input elements with the class "input"
    const inputs = document.querySelectorAll('.work_experiences');

    // Loop through each input element
    inputs.forEach(input => {
        const placeholder = input.previousElementSibling; // Get the previous sibling, which is the placeholder label

        // Add input event listener to each input element
        input.addEventListener('input', function() {
            if (input.value.trim() !== '') {
                placeholder.classList.add('active');
            } else {
                placeholder.classList.remove('active');
            }
        });

        // Add focus event listener to each input element
        input.addEventListener('focus', function() {
            placeholder.classList.add('active');
        });

        // Add blur event listener to each input element
        input.addEventListener('blur', function() {
            if (input.value.trim() === '') {
                placeholder.classList.remove('active');
            }
        });

        // Check if input has value on page load
        if (input.value.trim() !== '') {
            placeholder.classList.add('active');
        } else {
            placeholder.classList.remove('active');
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Get all input elements with the class "input"
    const inputs = document.querySelectorAll('#dob');

    // Loop through each input element
    inputs.forEach(input => {
        const placeholder = input.previousElementSibling; // Get the previous sibling, which is the placeholder label

        // Add input event listener to each input element
        input.addEventListener('input', function() {
            if (input.value.trim() !== '') {
                placeholder.classList.add('active');
            } else {
                placeholder.classList.remove('active');
            }
        });

        // Add focus event listener to each input element
        input.addEventListener('focus', function() {
            placeholder.classList.add('active');
        });

        // Add blur event listener to each input element
        input.addEventListener('blur', function() {
            if (input.value.trim() === '') {
                placeholder.classList.remove('active');
            }
        });

        // Check if input has value on page load
        if (input.value.trim() !== '') {
            placeholder.classList.add('active');
        } else {
            placeholder.classList.remove('active');
        }
    });
});

function limitCheckboxes(checkbox) {
    // Get all checkboxes with the name 'desire_work[]'
    const checkboxes = document.querySelectorAll('input[name="desire_work[]"]');
    
    // Count the number of checked checkboxes
    const checkedCount = Array.from(checkboxes).filter(cb => cb.checked).length;

    // If more than 3 checkboxes are checked, uncheck the current one and alert the user
    if (checkedCount > 3) {
        checkbox.checked = false;
        alert('You can select up to 3 options only.');
    }
}

document.getElementById('imageUpload').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const imagePreview = document.getElementById('imagePreview');
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
});
