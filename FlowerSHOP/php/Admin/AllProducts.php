

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AllProducts</title>
    <link rel="stylesheet" href="/FlowerSHOP/css/AdminAllProducts.css"> 
    
</head>
<body>
    <?php include('../includes/adminMenu.php'); ?> 

    <div class="container">
        <?php
        include('../includes/db.php');

        $sql = "SELECT DISTINCT f.id, f.name, f.category, f.description, f.image
                FROM flowers f";
        $result = $conn->query($sql);

     
        if ($result->num_rows > 0) {
    
            while ($flower = $result->fetch_assoc()) {
                ?>
                <div class="flower-box">
                
                    <img class="flower-image" src="/FlowerSHOP/php/uploads/<?php echo $flower['image']; ?>" alt="Product Image">

                    <h3><?php echo $flower['name']; ?></h3>
                    <p><?php echo $flower['category']; ?></p>

                    <div class="divButtonP" onclick="window.location.href='/FlowerSHOP/php/Admin/OneProduct.php?id=<?php echo $flower['id']; ?>'">
                        <button>Edit</button>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>No products available.</p>";
        }

      
        $conn->close();
        ?>
    </div>

</body>
</html>
