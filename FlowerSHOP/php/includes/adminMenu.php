<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel Menu</title>
    <link rel="stylesheet" href="/FlowerSHOP/css/adminMenu.css"> 
</head>
<body>

    <div class="sidebar">
       <div> 
        <div class="header">
            <h2>Admin Panel</h2>
        </div>
        <a href="/FlowerSHOP/php/Admin/AllProducts.php">Products</a>
        <a href="/FlowerSHOP/php/Admin/AllReservations.php">Reservations</a>
        <a href="/FlowerSHOP/php/Admin/AddProduct.php">Add Product</a>
        </div>
        <div>
        <button id="backtoPage" onclick="window.location.href='/FlowerSHOP/php/User/index.php'">Back to Website</button>
</div>
    </div>
   
</body>
</html>
