function validateForm() {
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    // Simple validation: Check if fields are not empty
    if (email === '' || password === '' ) {
      alert('Please fill out all fields');
      return false; // Prevent the form from submitting
    }

    // If the form passes validation, it will be submitted
    return true;
  }