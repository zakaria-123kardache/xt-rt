// Form validation
function validateForm(event) {
    event.preventDefault();
    
    let isValid = true;
    const email = document.getElementById('email');
    const password = document.getElementById('password');

    document.querySelectorAll('.error-message').forEach(error => error.style.display = 'none');

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

    if (isValid) {
        console.log('Login form submitted successfully');
    }
}

// Password visibility toggle
document.addEventListener('DOMContentLoaded', function() {
    const passwordToggle = document.querySelector('.password-toggle');
    const passwordInput = document.getElementById('password');

    passwordToggle.addEventListener('click', function() {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            this.classList.remove('fa-eye-slash');
            this.classList.add('fa-eye');
        } else {
            passwordInput.type = 'password';
            this.classList.remove('fa-eye');
            this.classList.add('fa-eye-slash');
        }
    });
});
