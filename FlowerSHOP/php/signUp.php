<?php
$pageTitle = "SignUp"; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="/FlowerSHOP/css/loginSignup.css"> 
</head>
<body>

<div class="form-container">
    <h1>Register</h1>

    <?php
   
    include('includes/db.php'); 

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
        $username = $_POST['username'];
        $password = $_POST['password'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $phoneNumber = $_POST['phoneNumber'];
        $email = $_POST['email'];

        $sql = "SELECT * FROM user WHERE username = '$username'";
        $result = $conn->query($sql); 
        if ($result->num_rows > 0) {
            echo "<p class='error'>Username already taken.</p>";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO user (username, password, name, surname, phoneNumber, email) 
                    VALUES ('$username', '$hashed_password', '$name', '$surname', '$phoneNumber', '$email')";
            
            if ($conn->query($sql) === TRUE) {
                header('Location: /FlowerSHOP/php/User/index.php'); 
                exit();
            } else {
                echo "<p class='error'>Error: " . $conn->error . "</p>";
            }
        }
    }
    ?>

    <form action="signup.php" method="POST">
        <table>
            <tr>
                <td><label for="username">Username:</label></td>
                <td><input type="text" id="username" name="username" required></td>
            </tr>

            <tr>
                <td><label for="password">Password:</label></td>
                <td><input type="password" id="password" name="password" required></td>
            </tr>

            <tr>
                <td><label for="name">Name:</label></td>
                <td><input type="text" id="name" name="name" required></td>
            </tr>

            <tr>
                <td><label for="surname">Surname:</label></td>
                <td><input type="text" id="surname" name="surname" required></td>
            </tr>

            <tr>
                <td><label for="phoneNumber">Phone Number:</label></td>
                <td><input type="text" id="phoneNumber" name="phoneNumber" required></td>
            </tr>

            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" id="email" name="email" required></td>
            </tr>

            <tr>
                <td colspan="2" id = "submit">
                    <button type="submit" >Register</button>
                </td>
            </tr>
        </table>
    </form>

    <button id="buttonBack" onclick="window.location.href='/FlowerSHOP/php/login.php'">Back to Login</button>
</div>

</body>
</html>
