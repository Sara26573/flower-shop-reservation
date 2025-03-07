<?php
$pageTitle = "Login"; 
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
    <h1>Login</h1>

    <?php
    include('includes/db.php'); 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $username = htmlspecialchars($username);
        $password = htmlspecialchars($password);

        $sql = "SELECT * FROM user WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id']; 
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

               
                if ($_SESSION['role'] == 'Admin') {
                    header("Location: /FlowerSHOP/php/Admin/AllProducts.php"); 
                } else {
                    header("Location: /FlowerSHOP/php/User/index.php"); 
                }
                exit();
            } else {
                $message = "Invalid password!";
            }
        } else {
            $message = "No user found with that username!";
        }
    }

    $conn->close();
    ?>

    <?php if (isset($message)) { echo "<p class='error'>$message</p>"; } ?>

    <form action="login.php" method="POST">
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
                <td colspan="2" id="submit">
                    <button type="submit">Login</button>
                </td>
            </tr>
        </table>
    </form>

    <button id="buttonBack" onclick="window.location.href='/FlowerSHOP/php/signup.php'">Back to Sign Up</button>
</div>

</body>
</html>
