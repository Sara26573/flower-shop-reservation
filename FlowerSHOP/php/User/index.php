<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/FlowerSHOP/css/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">

    <title>DropDownMenu</title>
</head>
<body>
    <?php include '../includes/header.php';
     include('../includes/db.php'); ?>

        <div class="banner">
            <h1>Rosa Flowers</h1>
            <h3>From Our Garden to Your Heart.<h3>
            <button onclick="window.location.href='/FlowerSHOP/php/User/FlowerBouquers.php'" id="buttonBanner" >RESERVE</button>
        
      
    </div>
       
        <p class="FlowerCategoryTitle">Our Flower Categories</p>
        <div class="containerCategory">
        <a href="/FlowerSHOP/php/User/FlowerBaskets.php">
        <div class="OneDiv">
            <img src="/FlowerSHOP/img/BImage.jpeg" alt="">
            <p class= "OneDivTitle">Flower Baskets</p>
            <p class="OneDivText">Beautifully crafted flower bouquets for every occasion, bringing elegance and joy.</p>
        </div>
        </a>
        <a href="/FlowerSHOP/php/User/FlowerBouquers.php">
        <div class="OneDiv">
            <img src="/FlowerSHOP/img/SImage.jpeg" alt="">
            <p class= "OneDivTitle">Flower Bouquets</p>
            <p class="OneDivText">Charming flower baskets, perfect for adding a touch of nature to any setting.</p>
        </div>
        </a>
        <a href="/FlowerSHOP/php/User/WeddingFlowers.php">
        <div class="OneDiv">
            <img src="/FlowerSHOP/img/LImage.jpeg" alt="">
            <p class= "OneDivTitle">Wedding Flower <br>Bouquets</p>
            <p class="OneDivText">Luxurious flower boxes designed to make your flowers stand out in style.</p>
        </div>
        </a>
        <a href="/FlowerSHOP/php/User/FlowerBoxes.php">
        <div class="OneDiv">
            <img src="/FlowerSHOP/img/NImage.jpeg" alt="">
            <p class= "OneDivTitle">Flower Boxes</p>
            <p class="OneDivText">Stunning wedding flowers to make your special day even more memorable.</p>
        </div>
        </a>
       </div>



    <p class="FlowerCategoryTitle">Our Products</p>
    <div class="container">
    <?php
        $sql = "SELECT DISTINCT f.id, f.name, f.category, f.image
                FROM flowers f WHERE category = 'Flower Bouquets' LIMIT 4 ";
        $result = $conn->query($sql);

     
        if ($result->num_rows > 0) {
            while ($flower = $result->fetch_assoc()) {
                ?>
                <div class="flower-box">
                
                    <img class="flower-image" src="/FlowerSHOP/php/uploads/<?php echo $flower['image']; ?>" alt="Product Image">

                    <h3><?php echo htmlspecialchars($flower['name']); ?></h3>
                    <p><?php echo htmlspecialchars($flower['category']); ?></p>

                    <div class="divButtonP" onclick="window.location.href='/FlowerSHOP/php/User/ReserveProduct.php?id=<?php echo $flower['id']; ?>'">
                        <button>VIEW MORE</button>
                    </div>
                </div>
           
                <?php
            }
        } else {
            echo "<p>No products available.</p>";
        }


?>
</div>


     <div class="ImagesClass">  

       <p>Make The Perfect Gift</p>

       <div class="images">

       <div class="firstBlockOne">
          <div class="imageOne">
         
          </div>
        </div>  
        <div class="firstBlock">
          <div class="imageOne">
            <p>Petals of Joy</p>
          </div>
        </div> 

        <div class="middleBlock"> 
         <div class= "imageOne">

            <p class="businessTitle">Rosa Flowers</p> 
            <button onclick="window.location.href='/FlowerSHOP/php/User/FlowerBouquers.php'" id="buttonImages" >VIEW MORE</button>
           </div>
         </div>
         
        <div class="secondBlock">
    
          <div class="imageTwo">
          <p>A Bouquet of Love</p>
          </div>
        </div> 

        <div class="lastBlock">
          <div class="imageOne">
           
          </div>
        </div> 
       </div>
</div>


<p class="FlowerCategoryTitle">Choose Us On Your Happiest Days</p>
    <div class="container">
    <?php
        $sql = "SELECT DISTINCT f.id, f.name, f.category, f.image
                FROM flowers f WHERE category = 'Wedding Flower Bouquets' LIMIT 4 ";
        $result = $conn->query($sql);

     
        if ($result->num_rows > 0) {
            while ($flower = $result->fetch_assoc()) {
                ?>
                <div class="flower-box">
                
                    <img class="flower-image" src="/FlowerSHOP/php/uploads/<?php echo $flower['image']; ?>" alt="Product Image">

                    <h3><?php echo htmlspecialchars($flower['name']); ?></h3>
                    <p><?php echo htmlspecialchars($flower['category']); ?></p>

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

<section class="OurStore">
  <div class="OurStoreOne">
    <p class="titleOurStore">Our Store</p>
    <p>Welcome to Rosa Flower Shop, where beauty blooms in every petal! <br><br>

Located in the heart of Shkoder, we take pride in offering a stunning selection of fresh flowers, elegant bouquets, and custom floral arrangements for every occasion. Whether you're celebrating love, expressing sympathy, or simply brightening someone's day, our handcrafted designs bring joy and elegance to any moment.<br><br>

We source our flowers from the finest growers, ensuring freshness and longevity. Our passionate florists are here to create something truly special just for you. Visit us in-store or shop online to experience the magic of flowers!
<br><br>
📍 Find us at: 1234 Luigj Gurakuqi Street<br>
📞 Call us: +698474857</p>
<button onclick="window.location.href='/FlowerSHOP/php/User/FlowerBouquers.php'" id="buttonBanner" >RESERVE</button>
  </div>
  <div class="OurStoreTwo">
    <img id="OurStoreTwoSecondImage" src="/FlowerSHOP/img/bride.jpeg" alt="">
  </div>
  
</section>



</body>

<?php 
        include('../includes/footer.php');
 ?>

</html>
