function validateForm1() {
    var email = document.getElementById('signInEmail').value;
    var password = document.getElementById('signInPassword').value;

    // Simple validation: Check if fields are not empty
    if (email === '' || password === '') {
        alert('Please fill out all fields');
        return false; // Prevent the form from submitting
    }

    // If the form passes validation, it will be submitted
    return true;
}


function validateForm2() {
    var fname = document.getElementById('signUpFirstName').value;
    var lname = document.getElementById('signUpLastName').value;
    var email = document.getElementById('signUpEmail').value;
    var password = document.getElementById('signUpPassword').value;
    var confirm_password = document.getElementById('signUpConfirmPassword').value;
    var address = document.getElementById('signUpAddress').value;
    var ph_no = document.getElementById('signUpPhone').value;


    // Simple validation: Check if fields are not empty
    if (fname === '' || lname === '' || email === '' || password === '' || confirm_password === '' || address === '' || ph_no === '') {
        alert('Please fill out all fields');
        return false; // Prevent the form from submitting
    }
    if(fname != confirm_password){
        alert('password must be same');

    }

    // If the form passes validation, it will be submitted
    return true;
}