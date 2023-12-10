<?php
global $conn;
$error = $success = "";
$sql = "";
function getCategory()
{
    global $conn;
    require('dbconnect.php');
    $sql = "SELECT * FROM category";
    $result = $conn->query($sql);

    $category = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $category[] = $row;
        }
    }

    return $category;
}

function addCategory($post)
{
    
    $name = $post['categoryName'];

    $description = $post['categoryDescription'];
    
    require('dbconnect.php');
    $sql = "INSERT INTO category (name, description)
     VALUES ('$name', '$description')";
   
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        unset($_POST);
        $success = "Category saved successfully.";
    }else{
        $error = "Something went wrong.Please try again.";
    }
    return $result;
}

function getCategoryById($id)
{
    global $conn;
    require('dbconnect.php');
    $sql = "SELECT * FROM category WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    return ($result->num_rows > 0) ? $result->fetch_assoc() : null;
}

function updateCategory($id, $name, $price)
{
    global $conn;
    require('dbconnect.php');
    $sql = "UPDATE category SET name='$name', price=$price WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function deleteCategory($id)
{
    global $conn;
    require('dbconnect.php');
    $sql = "DELETE FROM category WHERE id=$id";
    return mysqli_query($conn, $sql);
}
?>

<?php
// Function to read category from the file
// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        addCategory($_POST);
    } elseif (isset($_POST['update'])) {
       
        updateCategory($_POST);
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['delete'];
        deleteCategory($id);
    }
}
$category = getCategory();
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
        <p class="font-weight-bold">Category</p>
        <button style="text-align: right; height:40px; margin-bottom:0px" onclick="showAddCategoryForm()">Add Category</button>
    </div>
    <div class="cards" id="categoryList">
        <table>
            <thead>
                <tr>
                    <th>S.N</th>
                    <th>Category Name</th>
                    <th>Category Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sample data, replace with your actual category data -->
                <?php foreach ($category as $key => $categories): ?>
                    <tr>
                        <td>
                            <?php echo $key + 1; ?>
                        </td>
                        
                        <td>
                            <?php echo $categories['name']; ?>
                        </td>
                        
                        <td>
                            <?php echo $categories['description']; ?>
                        </td>
                        <td class="action-buttons">
                                <button onclick="deleteCategory(<?php echo $categories['id']; ?>)">Delete</button>
                            <button onclick="showEditCategoryForm(<?php echo $categories['id']; ?>)">Edit</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


</div>
<div id="addEditCategoryForm">
    <form action="admindashboard.php?tab=categories" method="post" id="categoryForm" enctype="multipart/form-data">
        <label for="categoryName">Category Name:</label>
        <input type="text" id="categoryName" name="categoryName" required>

        <label for="categoryDescription">Category Description:</label>
        <textarea id="categoryDescription" name="categoryDescription" rows="4" required></textarea>

       

        <input type="hidden" id="categoryId" name="categoryId">
        <button type="submit" name="add">Save Category</button>
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

    #categoryList {
        display: block;
        /* Display the category list by default */
    }

    #addEditCategoryForm {
        display: none;
        /* Hide the category add/edit form by default */
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
    function showAddCategoryForm() {
        document.getElementById("categoryList").style.display = "none";
        document.getElementById("addEditCategoryForm").style.display = "block";
        document.getElementById("categoryId").value = ""; // Clear any previous category ID
    }
    function fillFormWithData(data) {
        document.getElementById("categoryList").style.display = "none";
        document.getElementById("addEditCategoryForm").style.display = "block";
        document.getElementById("categoryId").value = categoryId; // Set the category ID for editing
        document.getElementById("categoryName").value = categoryData.name;
        document.getElementById("categoryPrice").value = categoryData.price;
        document.getElementById("categoryQuantity").value = categoryData.quantity;
        document.getElementById("categoryImage").value = categoryData.image;
    }

    function showEditCategoryForm(categoryId) {
        alert("i am editing category of id :"+categoryId);
        //$categoryData = getCategory(categoryId);
        // document.getElementById("categoryId").value = categoryId; // Set the category ID for editing
        // document.getElementById("categoryName").value = categoryData.name;
        // document.getElementById("categoryPrice").value = categoryData.price;
        // document.getElementById("categoryQuantity").value = categoryData.quantity;
        // document.getElementById("categoryImage").value = categoryData.image;
        fetch('Controller/get_category_data.php')
      .then(response => response.json())
      .then(data => fillFormWithData(data))
      .catch(error => console.error('Error fetching category data:', error));
    
    }

    function cancelAddEdit() {
        document.getElementById("categoryList").style.display = "block";
        document.getElementById("addEditCategoryForm").style.display = "none";
    }
    function deleteCategory(categoryId) {
        if (confirm('Are you sure you want to delete this category?')) {
            // Perform the delete action using AJAX or other appropriate method
            // Example: Redirect to a delete script with the category ID
            // window.location.href = 'delete_category.php?id=' + categoryId;
            fetch('Controller/delete_category_data.php?id=' + categoryId)
                .then(response => response.json())
                .then(data => {
                // Handle the success case with the parsed JSON data

                var container = document.getElementById('message');
                // container.innerHTML += 'Category Deleted sucessfully';
                    document.getElementById("table-"+categoryId).remove();
                    const successMessageDiv = document.createElement('div');
                    successMessageDiv.classList.add('alert', 'alert-success', 'mt-3');
                    successMessageDiv.role = 'alert';
                    successMessageDiv.style.position = 'relative';

                    // Add the success message and close button with inline styles
                    successMessageDiv.innerHTML = `
                <span style="margin-right: 10px;">Category deleted successfully</span>
                <button type="button" class="close" aria-label="Close" onclick="closeSuccessMessage(this)">
                    <span aria-hidden="true">&times;</span>
                </button>
            `;

                    // Append the success message div to the body or another container element
                    container.appendChild(successMessageDiv);
            })
            .catch(error => console.error('Error fetching category data:', error));
        }
    }
    function closeSuccessMessage(button) {
        const successMessageDiv = button.closest('.alert-success');
        if (successMessageDiv) {
            successMessageDiv.remove();
        }
        
    }
</script>