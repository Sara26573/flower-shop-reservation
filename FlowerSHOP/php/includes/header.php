<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/FlowerSHOP/css/header.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <title>DropDownMenu</title>
</head>
<body>
    <div class="Header">
        <img src="/FlowerSHOP/img/logoFLOWER.jpeg" alt="Flower Logo" />
        <ul>
            <li><a href="/FlowerSHOP/php/User/index.php">Home</a></li>
            <li><a href="/FlowerSHOP/php/User/AboutUs.php">About</a></li>
            <li><a href="/FlowerSHOP/php/User/FlowerBouquers.php">Categories <i class="fas fa-caret-down"></i></a>
              <div class="dropdown_menu">
                <ul>
                  <li><a href="#"></a></li>
                  <li><a href="#"></a></li>
                  <li><a href="/FlowerSHOP/php/User/FlowerBaskets.php">Flower Baskets</a></li>
                  <li><a href="/FlowerSHOP/php/User/FlowerBouquers.php">Flower Bouquets</a></li>
                  <li><a href="/FlowerSHOP/php/User/WeddingFlowers.php">Weeding Flower Bouquets </a></li>
                  <li><a href="/FlowerSHOP/php/User/FlowerBoxes.php">Flower Boxes</a></li>
                </ul>
              </div>
            </li>
            <li><a href="/FlowerSHOP/php/User/ContactUs.php">Contact</a></li>
            <li><a href="/FlowerSHOP/php/login.php"><i class="far fa-user"></i></a></li>
        </ul>
    </div>
</body>
</html>
