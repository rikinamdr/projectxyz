<?php
global $conn;
$error = $success = "";
$sql = "";


function getCustomers()
{
    global $conn;
    require('dbconnect.php');
    $customerID = $_SESSION['customer_id'];
    $sql = "SELECT products.name, products.price, orders.total_price, orders.order_date, orders.delivery_date, order_products.quaintity
     FROM orders JOIN order_products ON orders.id=order_products.order_id JOIN products ON order_products.product_id=products.id
     WHERE id=$customerID order by id DESC ";
    $result = $conn->query($sql);

    $customers = [];
    

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $customers[] = $row;
        }
    }

    return $customers;
}




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
</div>
<?php $customers = getCustomers();print_r($customers); die("ookokokookokokokokk"); ?>
<div>
    <div class="main-title">
        <p class="font-weight-bold">History</p>
        
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
            
            <?php foreach ($customers as $key => $customer): ?>
                <tr id="table-<?php echo $user['id'];?>">
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
                    <!-- <td class="action-buttons">
                        <button onclick="deleteUser(<?php echo $user['id']; ?>)">Delete</button>
                        <button onclick="showEditUserForm(<?php echo $user['id']; ?>)">Edit</button>
                    </td> -->
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>


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
    }

    #addEditUserForm {
        display: none;
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

    
    select:hover {
        border-color: #555;
    }

    select:focus {
        outline: none;
        border-color: #2196F3;
    }
</style>
<!-- <script>
    function submitForm() {
        var formData = new FormData(document.getElementById('userForm'));
        fetch("Controller/add_edit_admin_data.php", {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                // Handle the success case with the parsed JSON data
                // Handle the success case with the parsed JSON data
                var alerttext = data.success ? "success" : "error";
                var container = document.getElementById('message');
                const successMessageDiv = document.createElement('div');

                // Add classes and attributes to the created div
                successMessageDiv.classList.add('alert', 'alert-' + alerttext, 'mt-3');
                successMessageDiv.role = 'alert';
                successMessageDiv.style.position = 'relative';

                // Add the success message and close button with inline styles
                successMessageDiv.innerHTML = `
        <span style="margin-right: 10px;">${data.message}</span>
        <button type="button" class='close' aria-label="Close" onclick="closeSuccessMessage(this)">
            <span aria-hidden="true">&times;</span>
        </button>
    `;

                // Clear any previous messages in the container
                if (container && container.innerHTML.trim() !== '') {
                    container.innerHTML = '';
                }

                // Append the new success message div to the container
                container.appendChild(successMessageDiv);

                // Set a timeout to remove the message after 5000 milliseconds (5 seconds)
                setTimeout(function () {
                    container.innerHTML = '';

                    // Reload the page if the operation was successful
                    if (data.success == true) {
                        location.reload();
                    }
                }, 5000);


               

            })
            .catch(error => {
                console.error("Error:", error);
            })
    }

    function showAddUserForm() {
        document.getElementById('userForm').reset();
        document.getElementById("userList").style.display = "none";
        document.getElementById("addEditUserForm").style.display = "block";
        document.getElementById("userId").value = ""; // Clear any previous user ID
        document.getElementById('password').style.display = 'block';
        document.getElementById('confirmPassword').style.display = 'block';
        document.getElementById('password').previousElementSibling.style.display = 'block';
        document.getElementById('confirmPassword').previousElementSibling.style.display = 'block';

    }

    function fillFormWithData(data) {
        document.getElementById("userList").style.display = "none";
        document.getElementById("addEditUserForm").style.display = "block";

        document.getElementById("userId").value = data.id; // Set the user ID for editing
        document.getElementById("firstname").value = data.f_name; // Set the user ID for editing
        document.getElementById("lastname").value = data.l_name; // Set the user ID for editing
        document.getElementById("email").value = data.email;
        document.getElementById("email").value = data.email;
        var readOnlyPassword = document.getElementById('password');
        var readOnlyConfirmPassword = document.getElementById('confirmPassword');

        // Hide the elements
        if (readOnlyPassword && readOnlyConfirmPassword) {
            readOnlyPassword.style.display = 'none';
            var passwordlabel = readOnlyPassword.previousElementSibling;
            if (passwordlabel) {
                passwordlabel.style.display = 'none';
            }
            readOnlyConfirmPassword.style.display = 'none';
            var confirmPasswordLabel = readOnlyConfirmPassword.previousElementSibling;
            if (confirmPasswordLabel) {
                confirmPasswordLabel.style.display = 'none';
            }
        }
       
        document.getElementById('submit').name = "update";
    }

    function showEditUserForm(userId) {

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
            fetch('Controller/delete_admin_data.php?id=' + userId)
                .then(response => response.json())
                .then(data => {
                    // Handle the success case with the parsed JSON data
                    var alerttext = data.success ? "success" : "error";
                    var container = document.getElementById('message');
                    const successMessageDiv = document.createElement('div');
                    successMessageDiv.classList.add('alert', 'alert-' + alerttext, 'mt-3');
                    successMessageDiv.role = 'alert';
                    successMessageDiv.style.position = 'relative';

                    // Add the success message and close button with inline styles
                    successMessageDiv.innerHTML = `
            <span style="margin-right: 10px;">${data.message}</span>
            <button type="button" class='close' aria-label="Close" onclick="closeSuccessMessage(this)">
                <span aria-hidden="true">&times;</span>
            </button>
        `;
                    if (container && container.innerHTML.trim() !== '') {
                        container.innerHTML = '';
                    }
                    container.appendChild(successMessageDiv);
                    setTimeout(function () {
                        container.innerHTML = '';
                        location.reload()
                    }, 5000);

                })
                .catch(error => console.error('Error fetching user data:', error));
        }
    }

    function closeSuccessMessage(button) {
        const successMessageDiv = button.closest('.alert');
        if (successMessageDiv) {
            successMessageDiv.remove();
        }
    }
</script> -->