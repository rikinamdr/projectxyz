function validateForm() {
    // Reset error messages
    document.getElementById('emailError').innerText = '';
    document.getElementById('passwordError').innerText = '';
    document.getElementById('addressError').innerText = '';
    // document.getElementById('passwordError').innerText = '';



    // Get input values
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirmPassword').value;
    var address = document.getElementById('address').value;
    var fname = document.getElementById('fname').value;
    var lname = document.getElementById('lname').value;
    // var ph_no = document.getElementById('ph_no').value;

    if (fname.trim() === '') {
        alert('First Name is required.');
        return false;
    }

    if (lname.trim() === '') {
        alert('Last Name is required.');
        return false;
    }

    // Validate email format
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        document.getElementById('emailError').innerText = 'Invalid email .';
        return false;
    }

    // Validate password match
    if (password !== confirmPassword) {
        document.getElementById('passwordError').innerText = 'Passwords do not match.';
        return false;
    }

    // Validate other fields (non-empty)
    if (address.trim() === '') {
        document.getElementById('addressError').innerText = 'Address is required.';
        return false;
    }
    if (password.trim() === '') {
        document.getElementById('passError').innerText = 'Password is required';
        return false;
    }
    if (confirmPassword.trim() === '') {
        document.getElementById('passwordError').innerText = 'Re-type the password';
        return false;
    }
    




    // You can add more complex validation if needed

    // If all validations pass, the form will be submitted
    return true;
}