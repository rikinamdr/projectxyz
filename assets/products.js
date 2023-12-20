function validateForm() {
    var productName = document.getElementById('productName').value;
    var productDescription = document.getElementById('productDescription').value;
    var productPrice = document.getElementById('productPrice').value;
    var productCategory = document.getElementById('productCategory').value;
    var productQuantity = document.getElementById('productQuantity').value;
    var productImage = document.getElementById('productImage').value;    
    

    // Simple validation: Check if fields are not empty
    if (productName === '' || productDescription === '' || productPrice === '' || productCategory === '' || productQuantity === ''|| productImage === ''  ) {
      alert('Please fill out all fields');
      return false; // Prevent the form from submitting
    }

    // If the form passes validation, it will be submitted
    return true;
  }