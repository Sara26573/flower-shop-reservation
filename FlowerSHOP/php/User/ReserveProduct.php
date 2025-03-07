<?php
session_start();
include('../includes/db.php');
$flower_id = isset($_GET['id']) ? intval($_GET['id']) : 0;


$flowerQuery = $conn->prepare("SELECT name, category, description, image FROM flowers WHERE id = ?");
$flowerQuery->bind_param("i", $flower_id);
$flowerQuery->execute();
$flowerResult = $flowerQuery->get_result();
$flower = $flowerResult->fetch_assoc();

if (!$flower) {
    echo "Flower not found!";
    exit();
}


$sizeQuery = $conn->prepare("SELECT size, price, quantity FROM flower_sizes WHERE flower_id = ?");
$sizeQuery->bind_param("i", $flower_id);
$sizeQuery->execute();
$sizesResult = $sizeQuery->get_result();
$sizes = [];

while ($row = $sizesResult->fetch_assoc()) {
    $sizes[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/FlowerSHOP/css/ReserveProduct.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <title>Reserve <?php echo htmlspecialchars($flower['name']); ?></title>
    <script>
        function checkLoginAndReserve() {
            
            <?php if (!isset($_SESSION['user_id'])): ?>
                
                window.location.href = '/FlowerSHOP/php/login.php';
                return false; 
            <?php endif; ?>

            
            return true;
        }

        function updatePrice(price, stock) {
           
            document.getElementById('price').innerText = price.toFixed(2) + " EUR";
            document.getElementById('total_price').value = (price * document.getElementById('quantity').value).toFixed(2) + " EUR";
            document.getElementById('quantity').value = 1;
            document.getElementById('quantity').max = stock;
            document.getElementById('stockWarning').style.display = "none";
        }

        function validateQuantity(stock) {
            let quantity = parseInt(document.getElementById('quantity').value);
            if (quantity > stock) {
                document.getElementById('stockWarning').style.display = "block";
            } else {
                document.getElementById('stockWarning').style.display = "none";
            }

          
            let price = parseFloat(document.getElementById('price').innerText.replace(' EUR', ''));
            document.getElementById('total_price').value = (price * quantity).toFixed(2) + " EUR";
        }
    </script>
</head>
<body>

    <?php include '../includes/header.php'; ?>
    <div class="banner">
        <h1>Rosa Flowers</h1>
        <h3>Make A Reservation</h3> 
    </div>

    <div class="container">
        <img src="/FlowerSHOP/php/uploads/<?php echo $flower['image']; ?>" alt="Product Image">
        <div class="Information">
            <h1><?php echo htmlspecialchars($flower['name']); ?></h1>
            <h3>Category: <?php echo htmlspecialchars($flower['category']); ?></h3>
            <p><?php echo htmlspecialchars($flower['description']); ?></p>

            <form method="POST" action="ProcessReservation.php" onsubmit="return checkLoginAndReserve()">
                <input type="hidden" name="flower_id" value="<?php echo $flower_id; ?>">
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?? ''; ?>">

                <h4 style="font-weight:500;">Select Size:</h4>
                <?php foreach ($sizes as $size): ?>
                    <label>
                        <input type="radio" name="size" value="<?php echo $size['size']; ?>"
                               onclick="updatePrice(<?php echo $size['price']; ?>, <?php echo $size['quantity']; ?>)">
                        <?php echo $size['size']; ?>
                    </label>
                <?php endforeach; ?>

                <h4 style="font-weight:500;">Price: <span style="color:green;" id="price">Select a size</span></h4>

                <h4 style="font-weight:500;">Quantity:</h4>
                <input type="number" style="font-weight:500;" id="quantity" name="quantity" value="1" min="1" 
                       oninput="validateQuantity(parseInt(this.max))">

                <p id="stockWarning" style="color: red; display: none; font-weight:500;">Not enough stock available!</p>

                <h4 style="font-weight:500;">Comments (optional):</h4>
                <textarea name="comments" rows="3"></textarea>

                <h4 style="font-weight:500;">Choose Reservation Date:</h4>
                <input type="date" name="reservation_date" id="reservation_date" required>

                <h4>Total Price:</h4>
                <input type="text" id="total_price" name="total_price" value="0 EUR" readonly>
                 <br>
                <button type="submit">Reserve Now</button>
            </form>
        </div>
    </div>

</body>

<?php 
        include('../includes/footer.php');
 ?>
</html>
