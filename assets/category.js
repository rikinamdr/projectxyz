function validateForm() {
    var name = document.getElementById('name').value;
    var description = document.getElementById('description').value;

    // Simple validation: Check if fields are not empty
    if (name === '' || description === '' ) {
      alert('Please fill out all fields');
      return false; // Prevent the form from submitting
    }

    // If the form passes validation, it will be submitted
    return true;
  }