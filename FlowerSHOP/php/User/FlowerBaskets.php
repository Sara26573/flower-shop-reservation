<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/FlowerSHOP/css/FlowerBouqetsBanner.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">

    <title>DropDownMenu</title>
</head>
<body>
    <?php 
        include '../includes/header.php'; 
        include('../includes/db.php');
    ?>

    <div class="banner">
        <h1>Rosa Flowers</h1>
        <h3>Our Flower Baskets</h3> 
    </div>
    <p class="title">Flower Baskets</p>
    <div class="container">
      
    <?php
        $sql = "SELECT DISTINCT f.id, f.name, f.category, f.image
                FROM flowers f WHERE category = 'Flower Baskets'";
        $result = $conn->query($sql);

     
        if ($result->num_rows > 0) {
            while ($flower = $result->fetch_assoc()) {
                ?>
                <div class="flower-box">
                
                    <img class="flower-image" src="/FlowerSHOP/php/uploads/<?php echo $flower['image']; ?>" alt="Product Image">

                    <h3><?php echo $flower['name']; ?></h3>
                    <p><?php echo $flower['category']; ?></p>

                    <div class="divButtonP" onclick="window.location.href='/FlowerSHOP/php/User/ReserveProduct.php?id=<?php echo $flower['id']; ?>'">
                        <button>VIEW MORE</button>
                    </div>
                </div>
           
                <?php
            }
        } else {
            echo "<p>No products available.</p>";
        }

    
    mysqli_close($conn);

?>

</div>
<?php 
        include('../includes/footer.php');
 ?>
</body>
</html>
