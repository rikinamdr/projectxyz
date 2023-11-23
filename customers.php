<?php
global $conn;
$error = $success = "";
$sql = "";
function getCustomers()
{
    global $conn;
    require('dbconnect.php');
    $sql = "SELECT * FROM customers";
    $result = $conn->query($sql);

    $customers = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $customers[] = $row;
        }
    }

    return $customers;
}

function addCustomers($post)
{
    $email = $_POST['email'];
    $fname = $_POST['f_name'];
    $lname = $_POST['l_name'];
    // $password = $_POST['password'];
    // $imageName = '';
    // if (isset($_FILES['productImage'])) {
    //     $uploadDirectory = 'images/products/'; // Specify the directory where you want to save the product images

    //     // Get the details of the uploaded file
    //     $fileName = basename($_FILES['productImage']['name']);
    //     $targetPath = $uploadDirectory . $fileName;
    //     $fileType = pathinfo($targetPath, PATHINFO_EXTENSION);

    //     // Check if the file is an image
    //     $isImage = getimagesize($_FILES['productImage']['tmp_name']);
    //     if ($isImage !== false) {
    //         // Move the uploaded file to the specified directory
    //         if (move_uploaded_file($_FILES['productImage']['tmp_name'], $targetPath)) {
    //             // Read the contents of the uploaded image file as a binary string
    //             // $imageData = file_get_contents($targetPath);
    //             $imageName = $fileName;
    //             // Encode the binary image data as base64 to store in the database
    //             // $base64ImageData = base64_encode($imageData);
    //         }
    //     }
    // }
    
    require('dbconnect.php');
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // SQL query to insert data into the users table
    $query = "INSERT INTO customers (f_name, l_name,  email, password) VALUES ('$fname','$lname', '$email', '$hashedPassword')";    
    $result = mysqli_query($conn, $query);
    if ($result) {
            $success=  "User data inserted successfully.";
    } else {
            $error =  "Error: " . mysqli_error($conn);
        }
    // $sql = "INSERT INTO products (name, price,category,quantity,image,description)
    //  VALUES ('$name', $price,'$cat',$qty,'$fileName','$description')";
   
    // $result = mysqli_query($conn, $sql);
    
    // if ($result) {
    //     unset($_POST);
    //     $success = "Product saved successfully.";
    // }else{
    //     $error = "Something went wrong.Please try again.";
    // }
    return $result;
}

function getCustomer($id)
{
    global $conn;
    require('dbconnect.php');
    $sql = "SELECT * FROM customers WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    return ($result->num_rows > 0) ? $result->fetch_assoc() : null;
}

function updateProduct($id, $name, $price)
{
    global $conn;
    require('dbconnect.php');
    $sql = "UPDATE products SET name='$name', price=$price WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function deleteProduct($id)
{
    global $conn;
    require('dbconnect.php');
    $sql = "DELETE FROM products WHERE id=$id";
    return mysqli_query($conn, $sql);
}
?>

<?php
// Function to read products from the file
// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        addCustomers($_POST);
    } elseif (isset($_POST['update'])) {
       
        updateProduct($_POST);
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['delete'];
        deleteProduct($id);
    }
}
$customers = getCustomers();
?>

<div id="message">
    
<?php
if ($error) {
    ?>
    <div class="error">
        <?php echo $error; ?>
    </div>
    <?php
}
if ($success) {
    ?>
    <div class="success">
        <?php echo $success ?>
    </div>
    <?php
}
?>
<div>
    <div class="main-title">
        <p class="font-weight-bold">Customers</p>
        <button style="text-align: right; height:40px; margin-bottom:0px" onclick="showAddProductForm()">Add Product</button>
    </div>
    <div class="cards" id="productList">
        <table>
            <thead>
                <tr>
                    <th>S.N</th>
                    <th>First name</th>
                    <th>Last Name</th>
                    <th>email</th>
                    <th>action</th>

                    
                </tr>
            </thead>
            <tbody>
                <!-- Sample data, replace with your actual product data -->
                <?php foreach ($customers as $key => $customer): ?>
                    <tr>
                        <td>
                            <?php echo $key + 1; ?>
                        </td>
                        
                        <td>
                            <?php echo $customer['f_name']; ?>
                        </td>
                        <td>
                            <?php echo $customer['l_name']; ?>
                        </td>
                        <td>
                            <?php echo $customer['email']; ?>
                        </td>
                        <td class="action-buttons">
                                <button onclick="deleteProduct(<?php echo $customer['id']; ?>)">Delete</button>
                            <button onclick="showEditProductForm(<?php echo $customer['id']; ?>)">Edit</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


</div>
<div id="addEditProductForm">
    <form action="admindashboard.php?tab=customers" method="post" id="productForm" enctype="multipart/form-data">
        <label for="productName">First Name</label>
        <input type="text" id="productName" name="f_name" required>

        <label for="productDescription">Last Name</label>
        <textarea id="productDescription" name="l_name" rows="4" required></textarea>

        <label for="productPrice">email:</label>
        <input type="text" id="productPrice" name="email" step="0.01" required>

<!--         
        <label for="productCategory">Select a Shoes Category:</label>
        <select id="productCategory" name="productCategory">
        <option value="sports">Sports Shoes</option>
        <option value="casual">Casual Shoes</option>
        <option value="formal">Formal Shoes</option>
        <option value="sandals">Sandals</option>
        </select> -->

        <!-- <label for="productQuantity">Quantity:</label>
        <input type="number" id="productQuantity" name="productQuantity" required>

        <label for="productImage">Product Image :</label>
        <input type="file" id="productImage" name="productImage" required> -->

        <input type="hidden" id="productId" name="productId">
        <button type="submit" name="add">Save Customer</button>
        <button type="button" onclick="cancelAddEdit()">Cancel</button>

    </form>
</div>
<style>
    .cards {
        margin-top: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        overflow-x: auto;
        /* Enable horizontal scrolling on small screens */
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .action-buttons form,
    .action-buttons button {
        display: inline;
        padding: 5px 10px;
        margin-right: 5px;
        text-decoration: none;
        color: #fff;
        cursor: pointer;
    }

    #productList {
        display: block;
        /* Display the product list by default */
    }

    #addEditProductForm {
        display: none;
        /* Hide the product add/edit form by default */
        margin-top: 20px;
    }
    select {
       width: 100%;
      padding: 10px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 4px;
      cursor: pointer;
      margin-bottom: 20px;
    }

    /* Style for better visual presentation */
    select:hover {
      border-color: #555;
    }

    select:focus {
      outline: none;
      border-color: #2196F3; /* Add your preferred focus color */
    }
</style>

<script>
    function showAddProductForm() {
        document.getElementById("productList").style.display = "none";
        document.getElementById("addEditProductForm").style.display = "block";
        document.getElementById("productId").value = ""; // Clear any previous product ID
    }

    function showEditProductForm(productId) {
        alert("i am editing customer of id :"+customerId);
        //$productData = getProducts(productId);
        
        document.getElementById("productList").style.display = "none";
        document.getElementById("addEditProductForm").style.display = "block";
        document.getElementById("productId").value = productId; // Set the product ID for editing
        // document.getElementById("productName").value = productData.name;
        // document.getElementById("productPrice").value = productData.price;
        // document.getElementById("productQuantity").value = productData.quantity;
        // document.getElementById("productImage").value = productData.image;
    
    }
    function fillFormWithData(data) {
        document.getElementById("customerList").style.display = "none";
        document.getElementById("addCustomerProductForm").style.display = "block";

        document.getElementById("CustomerId").value = data.id; // Set the product ID for editing
        document.getElementById("f_name").value = data.f_name; // Set the product ID for editing
        document.getElementById("l_name").value = data.l_name; // Set the product ID for editing
        document.getElementById("email").value = data.email;
        // document.getElementById("productPrice").value = data.price;
        // document.getElementById("productQuantity").value = data.quantity;
        // // document.getElementById("productImage").value = data.image;
        // document.getElementById('submit').name = "update";
        // // alert(data.image);
        // var src = "images/products/" + data.image;

        // var container = document.getElementById('appendedImageContainer');
        // container.innerHTML += '<img style="height:100px; widht:150px;" src="' + src + '" alt="' + data.name + '">';
    }

    function cancelAddEdit() {
        document.getElementById("customerList").style.display = "block";
        document.getElementById("addEditCustomerForm").style.display = "none";
    }
    function deleteProduct(customerId) {
        if (confirm('Are you sure you want to delete this product?')) {
            fetch('Controller/delete_customer_data.php?id=' + customerId)
                .then(response => response.json())
                .then(data => {
            // Perform the delete action using AJAX or other appropriate method
            // Example: Redirect to a delete script with the product ID
            // window.location.href = 'delete_product.php?id=' + productId;
            var container = document.getElementById('message');
                // container.innerHTML += 'Product Deleted sucessfully';
                    document.getElementById("table-"+productId).remove();
                    const successMessageDiv = document.createElement('div');
                    successMessageDiv.classList.add('alert', 'alert-success', 'mt-3');
                    successMessageDiv.role = 'alert';
                    successMessageDiv.style.position = 'relative';

                    // Add the success message and close button with inline styles
                    successMessageDiv.innerHTML = `
                <span style="margin-right: 10px;">Product deleted successfully</span>
                <button type="button" class="close" aria-label="Close" onclick="closeSuccessMessage(this)">
                    <span aria-hidden="true">&times;</span>
                </button>
            `;

                    // Append the success message div to the body or another container element
                    container.appendChild(successMessageDiv);
        })
        .catch(error => console.error('Error fetching customer data:', error));

    }
    function closeSuccessMessage(button) {
        const successMessageDiv = button.closest('.alert-success');
        if (successMessageDiv) {
            successMessageDiv.remove();
        }
    }
    
</script>