<div>
    <div class="main-title">
        <p class="font-weight-bold">OVERVIEW</p>
    </div>
    <div class="main-cards">
        <div class="card">
            <div class="card-inner">
                <p class="text-primary">PRODUCTS</p>
                <span class="material-icons-outlined text-blue">inventory_2</span>
            </div>
            <span class="text-primary font-weight-bold">249</span>
        </div>

        <div class="card">
            <div class="card-inner">
                <p class="text-primary">PURCHASE ORDERS</p>
                <span class="material-icons-outlined text-orange">add_shopping_cart</span>
            </div>
            <span class="text-primary font-weight-bold">83</span>
        </div>

        <div class="card">
            <div class="card-inner">
                <p class="text-primary">SALES ORDERS</p>
                <span class="material-icons-outlined text-green">shopping_cart</span>
            </div>
            <span class="text-primary font-weight-bold">79</span>
        </div>

        <div class="card">
            <div class="card-inner">
                <p class="text-primary">NOTIFICATIONS</p>
                <span class="material-icons-outlined text-red">notification_important</span>
            </div>
            <span class="text-primary font-weight-bold">56</span>
        </div>
    </div>
</div>

<div id="Products" class="tabcontent">

    <div class="main-title">
        <p class="font-weight-bold">PRODUCTS</p>

        <p class="font-weight-bold tablinks" onclick="openCity(event, 'addProductPage')">Add product</p>
    </div>
    <div class="main-cards">

    </div>
</div>

<div id="purchaseOrder" class="tabcontent">
    <h3>purchaseOrder</h3>
    <p>Tokyo is the capital of Japan.</p>
</div>
<div id="addProductPage" class="tabcontent">
    <form action="process_product.php" method="post">
        <label for="productName">Product Name:</label>
        <input type="text" id="productName" name="productName" required>



        <label for="productDescription">Product Description:</label>
        <textarea id="productDescription" name="productDescription" rows="4" required></textarea>

        <label for="productPrice">Product Price:</label>
        <input type="number" id="productPrice" name="productPrice" step="0.01" required>

        <label for="productCategory">Category:</label>
        <input type="text" id="productCategory" name="productCategory" required>

        <label for="productQuantity">Quantity:</label>
        <input type="number" id="productQuantity" name="productQuantity" required>

        <label for="productImage">Product Image :</label>
        <input type="url" id="productImage" name="productImage" required>

        <button type="submit">Add Product</button>

    </form>
</div>