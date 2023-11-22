<?php
global $conn;
$error = $success = "";
$sql = "";
function getProducts()
{
    global $conn;
    require('dbconnect.php');
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    $products = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }

    return $products;
}

function addProduct($post)
{
    $name = $post['productName'];

    $description = $post['productDescription'];
    $price = $post['productPrice'];
    $cat = $post['productCategory'];
    $qty = $post['productQuantity'];
    $imageName = '';
    if (isset($_FILES['productImage'])) {
        $uploadDirectory = 'images/products/'; // Specify the directory where you want to save the product images

        // Get the details of the uploaded file
        $fileName = basename($_FILES['productImage']['name']);
        $targetPath = $uploadDirectory . $fileName;
        $fileType = pathinfo($targetPath, PATHINFO_EXTENSION);

        // Check if the file is an image
        $isImage = getimagesize($_FILES['productImage']['tmp_name']);
        if ($isImage !== false) {
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES['productImage']['tmp_name'], $targetPath)) {
                // Read the contents of the uploaded image file as a binary string
                // $imageData = file_get_contents($targetPath);
                $imageName = $fileName;
                // Encode the binary image data as base64 to store in the database
                // $base64ImageData = base64_encode($imageData);
            }
        }
    }
    
    require('dbconnect.php');
    $sql = "INSERT INTO products (name, price,category,quantity,image,description)
     VALUES ('$name', $price,'$cat',$qty,'$fileName','$description')";
   
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        unset($_POST);
        $success = "Product saved successfully.";
    }else{
        $error = "Something went wrong.Please try again.";
    }
    return $result;
}

function getProduct($id)
{
    global $conn;
    require('dbconnect.php');
    $sql = "SELECT * FROM products WHERE id = $id";
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
        addProduct($_POST);
    } elseif (isset($_POST['update'])) {
       
        updateProduct($_POST);
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['delete'];
        deleteProduct($id);
    }
}
$products = getProducts();
?>
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
        <p class="font-weight-bold">Product</p>
        <button style="text-align: right; height:40px; margin-bottom:0px" onclick="showAddProductForm()">Add Product</button>
    </div>
    <div class="cards" id="productList">
        <table>
            <thead>
                <tr>
                    <th>S.N</th>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sample data, replace with your actual product data -->
                <?php foreach ($products as $key => $product): ?>
                    <tr>
                        <td>
                            <?php echo $key + 1; ?>
                        </td>
                        <td>
                        <?php if (!empty($product['image'])): ?>
                    <img src="images/products/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" style="max-width: 100px; max-height: 100px;">
                <?php endif; ?>
                        </td>
                        <td>
                            <?php echo $product['name']; ?>
                        </td>
                        <td>
                            <?php echo $product['category']; ?>
                        </td>
                        <td>
                            <?php echo $product['price']; ?>
                        </td>
                        <td class="action-buttons">
                                <button onclick="deleteProduct(<?php echo $product['id']; ?>)">Delete</button>
                            <button onclick="showEditProductForm(<?php echo $product['id']; ?>)">Edit</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


</div>
<div id="addEditProductForm">
    <form action="admindashboard.php?tab=products" method="post" id="productForm" enctype="multipart/form-data">
        <label for="productName">Product Name:</label>
        <input type="text" id="productName" name="productName" required>

        <label for="productDescription">Product Description:</label>
        <textarea id="productDescription" name="productDescription" rows="4" required></textarea>

        <label for="productPrice">Product Price:</label>
        <input type="number" id="productPrice" name="productPrice" step="0.01" required>

        
        <label for="productCategory">Select a Shoes Category:</label>
        <select id="productCategory" name="productCategory">
        <option value="sports">Sports Shoes</option>
        <option value="casual">Casual Shoes</option>
        <option value="formal">Formal Shoes</option>
        <option value="sandals">Sandals</option>
        </select>

        <label for="productQuantity">Quantity:</label>
        <input type="number" id="productQuantity" name="productQuantity" required>

        <label for="productImage">Product Image :</label>
        <input type="file" id="productImage" name="productImage" required>

        <input type="hidden" id="productId" name="productId">
        <button type="submit" name="add">Save Product</button>
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
    function fillFormWithData(data) {
        document.getElementById("productList").style.display = "none";
        document.getElementById("addEditProductForm").style.display = "block";
        document.getElementById("productId").value = productId; // Set the product ID for editing
        document.getElementById("productName").value = productData.name;
        document.getElementById("productPrice").value = productData.price;
        document.getElementById("productQuantity").value = productData.quantity;
        document.getElementById("productImage").value = productData.image;
    }

    function showEditProductForm(productId) {
        alert("i am editing product of id :"+productId);
        //$productData = getProducts(productId);
        // document.getElementById("productId").value = productId; // Set the product ID for editing
        // document.getElementById("productName").value = productData.name;
        // document.getElementById("productPrice").value = productData.price;
        // document.getElementById("productQuantity").value = productData.quantity;
        // document.getElementById("productImage").value = productData.image;
        fetch('Controller/get_product_data.php')
      .then(response => response.json())
      .then(data => fillFormWithData(data))
      .catch(error => console.error('Error fetching product data:', error));
    
    }

    function cancelAddEdit() {
        document.getElementById("productList").style.display = "block";
        document.getElementById("addEditProductForm").style.display = "none";
    }
    function deleteProduct(productId) {
        if (confirm('Are you sure you want to delete this product?')) {
            // Perform the delete action using AJAX or other appropriate method
            // Example: Redirect to a delete script with the product ID
            window.location.href = 'delete_product.php?id=' + productId;
        }
    }
</script>