var shoppingCart = (function () {

    cart = [];

    function Item(name, image, id, price, count) {
        this.name = name;
        this.image = image;
        this.id = id;
        this.price = price;
        this.count = count;
    }

    // Save cart
    function saveCart() {
        localStorage.setItem('shoppingCart', JSON.stringify(cart));
    }

    // Load cart
    function loadCart() {
        cart = JSON.parse(localStorage.getItem('shoppingCart'));
    }

    if (localStorage.getItem("shoppingCart") != null) {
        loadCart();
    }


    var obj = {};

    // Add to cart
    obj.addItemToCart = function (name, image, id, price, count) {
        for (var item in cart) {
            if (cart[item].name === name) {
                cart[item].count++;
                saveCart();
                return;
            }
        }
        var item = new Item(name, image, id, price, count);
        cart.push(item);
        saveCart();
    }
    // Set count from item
    obj.setCountForItem = function (name, count) {
        for (var i in cart) {
            if (cart[i].name === name) {
                cart[i].count = count;
                break;
            }
        }
    };
    // Remove item from cart
    obj.removeItemFromCart = function (name) {
        for (var item in cart) {
            if (cart[item].name === name) {
                cart[item].count--;
                if (cart[item].count === 0) {
                    cart.splice(item, 1);
                }
                break;
            }
        }
        saveCart();
    }

    // Remove all items from cart
    obj.removeItemFromCartAll = function (id) {
        for (var item in cart) {
            if (cart[item].id === id) {
                cart.splice(item, 1);
                break;
            }
        }
        saveCart();
    }

    // Clear cart
    obj.clearCart = function () {
        cart = [];
        saveCart();
    }

    // Count cart 
    obj.totalCount = function () {
        var totalCount = 0;
        for (var item in cart) {
            totalCount += cart[item].count;
        }
        return totalCount;
    }

    // Total cart
    obj.totalCart = function () {
        var totalCart = 0;
        for (var item in cart) {
            totalCart += cart[item].price * cart[item].count;
        }
        return Number(totalCart.toFixed(2));
    }

    // List cart
    obj.listCart = function () {
        var cartCopy = [];
        for (i in cart) {
            item = cart[i];
            itemCopy = {};
            for (p in item) {
                itemCopy[p] = item[p];
            }
            itemCopy.total = Number(item.price * item.count).toFixed(2);
            cartCopy.push(itemCopy)
        }
        return cartCopy;
    }
    return obj;
})();


// Add item
$('.default-btn').click(function (event) {
    // alert('working');
    event.preventDefault();
    var name = $(this).data('name');
    var image = $(this).data('image');
    var id = $(this).data('id');
    var price = Number($(this).data('price'));
    shoppingCart.addItemToCart(name, image, id, price, 1);
    displayCart();
});

// Clear items
$('.clear-cart').click(function () {
    shoppingCart.clearCart();
    displayCart();
});

function displayCart() {
    var cartArray = shoppingCart.listCart();
    var output = "";

    for (var i in cartArray) {
        output += "<tr id=" + cartArray[i].id + " width='100%'>"
            + "<td ><img  style='width: 200px; height: 50px;'src='" + cartArray[i].image + "'><p>" + cartArray[i].name + "</p></td>"
            + "<td>(" + cartArray[i].price + ")</td>"
            + "<td><div class='input-group'>"
            + "<input type='number' name='qty[]' class='item-count form-control' style='width: 60px;' data-name='" + cartArray[i].name + "' value='" + cartArray[i].count + "'>"
            + "</div></td>"
            + "<td>" + cartArray[i].total + "</td>"
            + "<td><button class='delete-item btn btn-danger' data-name='" + cartArray[i].name + "' data-id='" + cartArray[i].id + "'>X</button></td>"
            + "</tr>";
    }

    $('.show-cart').html(output);
    $('.total-cart').html(shoppingCart.totalCart());
    $('.total-count').html(shoppingCart.totalCount());
}


$('.show-cart').on("click", ".delete-item", function (event) {
    var id = $(this).data('id')
    shoppingCart.removeItemFromCartAll(id);
    displayCart();
})

// Item count input
$('.show-cart').on("change", ".item-count", function (event) {
    var name = $(this).data('name');
    var count = Number($(this).val());
    shoppingCart.setCountForItem(name, count);
    displayCart();
});
displayCart();

//////// ui script start /////////
// Tabs Single Page
$('.tab ul.tabs').addClass('active').find('> li:eq(0)').addClass('current');
$('.tab ul.tabs li a').on('click', function (g) {
    var tab = $(this).closest('.tab'),
        index = $(this).closest('li').index();
    tab.find('ul.tabs > li').removeClass('current');
    $(this).closest('li').addClass('current');
    tab.find('.tab_content').find('div.tabs_item').not('div.tabs_item:eq(' + index + ')').slideUp();
    tab.find('.tab_content').find('div.tabs_item:eq(' + index + ')').slideDown();
    g.preventDefault();
});

// search function
$('#search_field').on('keyup', function () {
    var value = $(this).val();
    var patt = new RegExp(value, "i");

    $('.tab_content').find('.col-lg-3').each(function () {
        var $table = $(this);

        if (!($table.find('.featured-item').text().search(patt) >= 0)) {
            $table.not('.featured-item').hide();
        }
        if (($table.find('.col-lg-3').text().search(patt) >= 0)) {
            $(this).show();
            document.getElementById('not_found').style.display = 'none';
        } else {
            document.getElementById("not_found").innerHTML = " Product not found..";
            document.getElementById('not_found').style.display = 'block';
        }

    });

});
$('.checkoutButton').on('click', function (e) {
    // Prevent the default form submission
    e.preventDefault();

    // Get the form element using 'this' directly
    var $form = $(this).closest('form');

    // Initialize the jQuery Validation plugin on the form
    $form.validate();

    // Check if the form is valid
    if ($form.valid()) {

        // Collect all form data using serializeArray
        var formData = $form.serialize();


        // Extract grand total directly from the element, assuming it's a numeric value
        var grandTotal = parseFloat($('.total-cart').text().replace('$', ''));

        var orderDetails = {
            formData: formData,
            grandTotal: grandTotal,
            products: []
        };

        // Loop through each product in the cart and create an object
        $('.show-cart tr').each(function () {
            var productId = $(this).attr('id');
            var productPrice = parseFloat($(this).find('td:nth-child(2)').text().replace('$', ''));
            var productQuantity = parseInt($(this).find('.item-count').val(), 10);
            var productTotal = parseFloat($(this).find('td:nth-child(4)').text().replace('$', ''));

            // Ensure that the product details are valid before pushing to the array
            if (!isNaN(productId)) {
                orderDetails.products.push({
                    id: productId,
                    price: productPrice,
                    quantity: productQuantity,
                    total: productTotal
                });
            }
        });

        // Log orderDetails for debugging purposes
        console.log(orderDetails);

        // Check if there are products in the order
        if (orderDetails.products.length > 0) {
            // Make an AJAX request to save the order data using $.ajax
            $.ajax({
                url: "Controller/save_order_data.php",
                type: "POST",
                data: orderDetails, // Use the serialized form data
                success: function(response) { var response = JSON.parse(response);
                    console.log(response.message); // Check the response in the console
                    // Handle the response here
                    console.log('Success!'); // Log success to the console
                    console.log('Order details sent successfully:', response);
                    // Handle the success case with the parsed JSON data
                    var alerttext = response.success ? "success" : "error";
                    var container = document.getElementById('message');
                    const successMessageDiv = document.createElement('div');
                    successMessageDiv.classList.add('alert', 'alert-' + alerttext, 'mt-3');
                    successMessageDiv.role = 'alert';
                    successMessageDiv.style.position = 'relative';

                    // Add the success message and close button with inline styles
                    successMessageDiv.innerHTML = `
            <span style="margin-right: 10px;">${response.message}</span>
            <button type="button" class='close btn-close' aria-label="Close"  onclick="closeSuccessMessage(this)">
                <span aria-hidden="true">&times;</span>
            </button>
        `;
                    if (container && container.innerHTML.trim() !== '') {
                        container.innerHTML = '';
                    }
                    container.appendChild(successMessageDiv);
                    $('#successMessage').text(response.message);
                    // Show the modal
                    if (response.success == true) {
                        shoppingCart.clearCart();
                        displayCart();
                        $('#form1')[0].reset();
                        $('#form2')[0].reset();
                        setTimeout(function () {
                            $('#paymentCartModal').modal('hide');
                        }, 5000);

                    }else{
                        setTimeout(function () {
                            container.innerHTML = '';
                            $('#paymentCartModal').modal('hide');
                        }, 5000);
                    }


                    // Handle success if needed
                },
                error: function(error) {
                    console.error("Error:", error);
                    // Handle error if needed
                }
            });
        } else {
            alert("Please select at least one product to checkout");
            // Optionally, you might want to prevent further execution here
            return false;
        }
    }
});
function closeSuccessMessage(button) {
    const successMessageDiv = button.closest('.alert');
    if (successMessageDiv) {
        successMessageDiv.remove();
    }
}

// Function to send order details to the server
