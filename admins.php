<?php
global $conn;
$error = $success = "";
$sql = "";
function getUsers()
{
    global $conn;
    require('dbconnect.php');
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    $users = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }

    return $users;
}

function addUser($post)
{
    $f_name = $post['f_name'];
    $l_name = $post['l_name'];
    $email = $post['email'];
    $confirmpassword = $post['confirmPassword'];

    $password = $post['password'];
    if($password == $confirmpassword) {
        $error='Password and Confirm password does not match';
    }

    else{
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        require('dbconnect.php');
        $sql = "INSERT INTO users (f_name, l_name, email, password)
         VALUES ('$f_name', '$l_name', '$email', '$hashedPassword')";
       
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
            unset($_POST);
            $success = "User saved successfully.";
        }else{
            $error = "Something went wrong.Please try again.";
        }
        return $result;

    }

}

function getUser($id)
{
    global $conn;
    require('dbconnect.php');
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    return ($result->num_rows > 0) ? $result->fetch_assoc() : null;
}

function updateUser($id, $name, $price)
{
    global $conn;
    require('dbconnect.php');
    $sql = "UPDATE users SET name='$name', price=$price WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function deleteUser($id)
{
    global $conn;
    require('dbconnect.php');
    $sql = "DELETE FROM users WHERE id=$id";
    return mysqli_query($conn, $sql);
    
}
?>

<?php
// Function to read users from the file
// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        addUser($_POST);
    } elseif (isset($_POST['update'])) {
       
        updateUser($_POST);
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['delete'];
        deleteUser($id);
    }
}
$users = getUsers();
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
        <p class="font-weight-bold">User</p>
        <button style="text-align: right; height:40px; margin-bottom:0px" onclick="showAddUserForm()">Add User</button>
    </div>
    <div class="cards" id="userList">
        <table>
            <thead>
                <tr>
                    <th>S.N</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sample data, replace with your actual user data -->
                <?php foreach ($users as $key => $user): ?>
                    <tr>
                        <td>
                            <?php echo $key + 1; ?>
                        </td>
                        
                        <td>
                            <?php echo $user['f_name']; ?>
                        </td>
                        <td>
                            <?php echo $user['l_name']; ?>
                        </td>
                        <td>
                            <?php echo $user['email']; ?>
                        </td>
                        <td class="action-buttons">
                                <button onclick="deleteUser(<?php echo $user['id']; ?>)">Delete</button>
                            <button onclick="showEditUserForm(<?php echo $user['id']; ?>)">Edit</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


</div>
<div id="addEditUserForm">
    <form id="userForm" enctype="multipart/form-data">      
        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" name="f_name" required>

        <label for="lastname">Last Name:</label>
        <input type="text" id="lastname" name="l_name" rows="4" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email"  required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password"  required>

        <label for="confirmPassword">Conirm Password:</label>
        <input type="password" id="confirmPassword" name="confirmPassword" required>

        
        <!-- <label for="userCategory">Select a Shoes Category:</label>
        <select id="userCategory" name="userCategory">
        <option value="sports">Sports Shoes</option>
        <option value="casual">Casual Shoes</option>
        <option value="formal">Formal Shoes</option>
        <option value="sandals">Sandals</option>
        </select>

        <label for="userQuantity">Quantity:</label>
        <input type="number" id="userQuantity" name="userQuantity" required>

        <label for="userImage">User Image :</label>
        <input type="file" id="userImage" name="userImage" required> -->

        <input type="hidden" id="userId" name="userId">
        <button type="button" onclick="submitForm()" name="add">Save User</button>
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

    #userList {
        display: block;
        /* Display the user list by default */
    }

    #addEditUserForm {
        display: none;
        /* Hide the user add/edit form by default */
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
    function submitForm(){
        alert("test");
        var formData = new FormData(document.getElementById('userForm'));
        fetch("Controller/add_user_data.php",{
            method:'POST',
            body:formData
        })
        .then(response => response.json())
        .then(data=>{
            console.log(data);
        })
        .catch(error=>{
            console.error("Error:",error);
        })
    }

    function showAddUserForm() {
        document.getElementById("userList").style.display = "none";
        document.getElementById("addEditUserForm").style.display = "block";
        document.getElementById("userId").value = ""; // Clear any previous user ID
    }

    function fillFormWithData(data) {
        document.getElementById("userList").style.display = "none";
        document.getElementById("addEditUserForm").style.display = "block";

        document.getElementById("userId").value = data.id; // Set the user ID for editing
        document.getElementById("firstname").value = data.f_name; // Set the user ID for editing
        document.getElementById("lastname").value = data.l_name; // Set the user ID for editing
        document.getElementById("email").value = data.email;
        document.getElementById("password").value = data.password;
        // document.getElementById("userQuantity").value = data.quantity;
        // document.getElementById("userImage").value = data.image;
        document.getElementById('submit').name = "update";
        // alert(data.image);
        // var src = "images/users/" + data.image;

        // var container = document.getElementById('appendedImageContainer');
        // container.innerHTML += '<img style="height:100px; widht:150px;" src="' + src + '" alt="' + data.name + '">';
    }
    function showEditUserForm(userId) {
        alert("i am editing user of id :"+userId);
        //$userData = getUsers(userId);
        
        // document.getElementById("userList").style.display = "none";
        // document.getElementById("addEditUserForm").style.display = "block";
        // document.getElementById("userId").value = userId; // Set the user ID for editing
        // // document.getElementById("userName").value = userData.name;
        // // document.getElementById("userPrice").value = userData.price;
        // // document.getElementById("userQuantity").value = userData.quantity;
        // // document.getElementById("userImage").value = userData.image;
        fetch('Controller/get_admin_data.php?id=' + userId)
            .then(response => response.json())
            .then(data => fillFormWithData(data))
            .catch(error => console.error('Error fetching user data:', error));
    
    }

    function cancelAddEdit() {
        document.getElementById("userList").style.display = "block";
        document.getElementById("addEditUserForm").style.display = "none";
    }
    function deleteUser(userId) {
        if (confirm('Are you sure you want to delete this user?')) {
            // Perform the delete action using AJAX or other appropriate method
            // Example: Redirect to a delete script with the user ID
            // window.location.href = 'delete_admin.php?id=' + userId;
            fetch('Controller/delete_admin_data.php?id=' + userId)
                .then(response => response.json())
                .then(data => {
                // Handle the success case with the parsed JSON data

                var container = document.getElementById('message');
                // container.innerHTML += 'User Deleted sucessfully';
                    document.getElementById("table-"+userId).remove();
                    const successMessageDiv = document.createElement('div');
                    successMessageDiv.classList.add('alert', 'alert-success', 'mt-3');
                    successMessageDiv.role = 'alert';
                    successMessageDiv.style.position = 'relative';

                    // Add the success message and close button with inline styles
                    successMessageDiv.innerHTML = `
                <span style="margin-right: 10px;">User deleted successfully</span>
                <button type="button" class="close" aria-label="Close" onclick="closeSuccessMessage(this)">
                    <span aria-hidden="true">&times;</span>
                </button>
            `;

                    // Append the success message div to the body or another container element
                    container.appendChild(successMessageDiv);
            })
                .catch(error => console.error('Error fetching user data:', error));
        }
    }
    function closeSuccessMessage(button) {
        const successMessageDiv = button.closest('.alert-success');
        if (successMessageDiv) {
            successMessageDiv.remove();
        }
    }
</script>