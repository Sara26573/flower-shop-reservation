<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $to = "";
    $headers = "From: $email";
    $body = "Name: $name\nEmail: $email\nSubject: $subject\n\n$message";

    if (mail($to, $subject, $body, $headers)) {
        echo "Thank you for contacting us!";
    } else {
        echo "Something went wrong. Please try again later.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/FlowerSHOP/css/ContactUs.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">

    <title>Contact Us</title>
</head>
<body>
    <?php include '../includes/header.php';?>

    <div class="banner">
        <h1>Contact Us</h1>
    </div>

    <section class="contact-form-section">
        <div class="contact-form-container">
            <h2>We'd love to hear from you!</h2>
            <form action="ContactUs.php" method="POST" id="contactForm">
                <label for="name">Your Name</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Your Email</label>
                <input type="email" id="email" name="email" required>

                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" required>

                <label for="message">Your Message</label>
                <textarea id="message" name="message" rows="6" required></textarea>

                <button type="submit" id="buttonSubmit">Submit</button>
            </form>
        </div>
        <div class="contact-form-data-container">
            <h2>Feel free to reach Us</h2>
            <table>
            <tr>
                <td>Address:</td>
                <td>1234 Luigj Gurakuqi Street</td>
            </tr>
            <tr>
                <td></td>
                <td>Shkoder, IL 62704</td>
            </tr>
            <tr>
                <td>Mail:</td>
                <td>rosaStore@gmail.com</td>
            </tr>
            <tr>
                <td>Tel.N:</td>
                <td>+698474857</td>
            </tr>
          </table>
          <div>
        <img src="/FlowerSHOP/img/icons8-facebook.svg" alt="">
        <img src="/FlowerSHOP/img/icons8-instagram.svg" alt="">
        <img src="/FlowerSHOP/img/icons8-whatsapp.svg" alt="">
       </div>
        </div>

    </section>

    <p class="Explore">Explore Our Store</p>
    <p class="ExploreTwo">We are always at your service for the greatest experience</p>
    <div class="AllImages">
        
        <img id="imageOne" src="/FlowerSHOP/img/flowerBicycle.jpeg" alt="">
        <img id="imageTwo" src="/FlowerSHOP/img/flowerSTORE.jpeg" alt="">
        
        <img id="imageThree" src="/FlowerSHOP/img/carFlowers.jpeg" alt="">
    </div>

    <div></div>
    <?php include('../includes/footer.php');?>
</body>
</html>
