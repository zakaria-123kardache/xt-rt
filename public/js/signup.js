// Form validation
function validateForm(event) {
    event.preventDefault();
    
    let isValid = true;
    const fullname = document.getElementById('fullname');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm-password');

    document.querySelectorAll('.error-message').forEach(error => error.style.display = 'none');

    if (fullname.value.length < 3) {
        document.getElementById('fullname-error').textContent = 'Name must be at least 3 characters';
        document.getElementById('fullname-error').style.display = 'block';
        isValid = false;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email.value)) {
        document.getElementById('email-error').textContent = 'Please enter a valid email';
        document.getElementById('email-error').style.display = 'block';
        isValid = false;
    }

    if (password.value.length < 8) {
        document.getElementById('password-error').textContent = 'Password must be at least 8 characters';
        document.getElementById('password-error').style.display = 'block';
        isValid = false;
    }

 
    if (password.value !== confirmPassword.value) {
        document.getElementById('confirm-password-error').textContent = 'Passwords do not match';
        document.getElementById('confirm-password-error').style.display = 'block';
        isValid = false;
    }

    if (isValid) {

        console.log('Form submitted successfully');
    }
}

// Password visibility toggle
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.password-toggle').forEach(toggle => {
        toggle.addEventListener('click', function() {
            const input = this.previousElementSibling;
            if (input.type === 'password') {
                input.type = 'text';
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            } else {
                input.type = 'password';
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            }
        });
    });
});
