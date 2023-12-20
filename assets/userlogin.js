
    function validateForm() {
        // Reset error messages
        document.getElementById('emailError').innerText = '';
        document.getElementById('passwordError').innerText = '';

        // Get input values
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;

        // Validate email
        if (email.trim() === '') {
            document.getElementById('emailError').innerText = 'Please enter your email.';
            return false;
        }

        
        if (password.trim() === '') {
            document.getElementById('passwordError').innerText = 'Please enter your password.';
            return false;
        }

        
        return true;
    }
