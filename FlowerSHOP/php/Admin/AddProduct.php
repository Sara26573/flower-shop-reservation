<?php
include('../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    if ($_FILES['image']['error'] == 0) {
        $image_name = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $upload_dir = "../uploads/";
        $upload_file = $upload_dir . basename($image_name);

        if (move_uploaded_file($image_tmp_name, $upload_file)) {
    
            $name = $_POST['name'];
            $category = $_POST['category'];
            $description = $_POST['description'];
            $image = $image_name;

            $sql = "INSERT INTO flowers (name, category, image, description) 
                    VALUES ('$name', '$category', '$image', '$description')";
            if ($conn->query($sql) === TRUE) {
               
                $flower_id = $conn->insert_id;

                if (!empty($_POST['size_s']) && !empty($_POST['quantity_s'])) {
                    $size_s = $_POST['size_s'];
                    $quantity_s = $_POST['quantity_s'];
                    $sql_size_s = "INSERT INTO flower_sizes (flower_id, size, price, quantity) 
                                   VALUES ($flower_id, 'S', $size_s, $quantity_s)";
                    $conn->query($sql_size_s);
                }

                if (!empty($_POST['size_m']) && !empty($_POST['quantity_m'])) {
                    $size_m = $_POST['size_m'];
                    $quantity_m = $_POST['quantity_m'];
                    $sql_size_m = "INSERT INTO flower_sizes (flower_id, size, price, quantity) 
                                   VALUES ($flower_id, 'M', $size_m, $quantity_m)";
                    $conn->query($sql_size_m);
                }

                if (!empty($_POST['size_l']) && !empty($_POST['quantity_l'])) {
                    $size_l = $_POST['size_l'];
                    $quantity_l = $_POST['quantity_l'];
                    $sql_size_l = "INSERT INTO flower_sizes (flower_id, size, price, quantity) 
                                   VALUES ($flower_id, 'L', $size_l, $quantity_l)";
                    $conn->query($sql_size_l);
                }

                echo "<script>
                       alert('Product created successfully!');
                       window.location.href = window.location.href;
                       </script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "<script>
            alert('Error uploading image!');
            </script>";
        }
    } else {
        echo "<script>
        alert('No image selected or upload error!');
        </script>";
    }
}

$query = "SHOW COLUMNS FROM flowers WHERE Field = 'category'";
$result = $conn->query($query);
$row = $result->fetch_assoc();

$type = $row['Type']; 
$type = str_replace("enum(", "", $type);
$type = rtrim($type, ")");
$type = str_replace("'", "", $type);
$categories = explode(",", $type);


include('../includes/adminMenu.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Flower</title>
    <link rel="stylesheet" href="/FlowerSHOP/css/AddProduct.css">
</head>
<body>

<div class="container">
    <form action="AddProduct.php" method="POST" enctype="multipart/form-data">
        <div>
            <h2 style="margin-bottom: 30px">Add a New Flower</h2>
            <label for="name">Flower Name:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="category">Category:</label>
            <select name="category" required>
                <?php foreach ($categories as $cat) { ?>
                    <option value="<?php echo $cat; ?>">
                      <?php echo $cat; ?>
                    </option>
                <?php } ?>
            </select><br><br>

            <label for="image">Flower Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required><br><br>

            <label for="description">Description:</label><br>
            <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>
        </div>
        <div>
            <table>
                <tr>
                    <td><label for="size_s">Small Size:</label></td>
                    <td><input type="number" id="size_s" name="size_s" placeholder="Price for Small"></td>
                    <td><input type="number" id="quantity_s" name="quantity_s" placeholder="Quantity for Small"></td>
                </tr>
                <tr>
                    <td><label for="size_m">Medium Size:</label></td>
                    <td><input type="number" id="size_m" name="size_m" placeholder="Price for Medium"></td>
                    <td><input type="number" id="quantity_m" name="quantity_m" placeholder="Quantity for Medium"></td>
                </tr>
                <tr>
                    <td><label for="size_l">Large Size:</label></td>
                    <td><input type="number" id="size_l" name="size_l" placeholder="Price for Large"></td>
                    <td><input type="number" id="quantity_l" name="quantity_l" placeholder="Quantity for Large"></td>
                </tr>
            </table>

            <button type="submit">Add Flower</button>
        </div>
    </form>
</div>

</body>
</html>

<?php
$conn->close();
?>
