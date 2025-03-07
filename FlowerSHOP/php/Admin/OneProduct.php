<?php
include('../includes/db.php');

if (!isset($_GET['id'])) {
    echo "No product ID specified.";
    exit;
}

$productId = $_GET['id'];

$categoryQuery = "SHOW COLUMNS FROM flowers LIKE 'category'";
$categoryResult = $conn->query($categoryQuery);
$categoryRow = $categoryResult->fetch_assoc();

$type = $categoryRow['Type']; 
$type = str_replace("enum(", "", $type);
$type = rtrim($type, ")");
$type = str_replace("'", "", $type);
$categories = explode(",", $type);

$sql = "SELECT f.id, f.name, f.category, f.description, f.image, fs.size, fs.price, fs.quantity
        FROM flowers f
        LEFT JOIN flower_sizes fs ON f.id = fs.flower_id
        WHERE f.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $productId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Product not found.";
    exit;
}

$flower = null;
$sizes = [];
while ($row = $result->fetch_assoc()) {   //prsh ka 3 masa ka 3 rreshta
    if (!$flower) {
        $flower = [
            'id' => $row['id'],
            'name' => $row['name'],
            'category' => $row['category'],
            'description' => $row['description'],
            'image' => $row['image'],
        ];
    }
    $sizes[$row['size']] = [
        'price' => $row['price'],
        'quantity' => $row['quantity']  
    ];
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update'])) {

     
        $name = $_POST['name'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $selectedSize = $_POST['size'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
       
        $updateFlowerSql = "UPDATE flowers SET name = ?, category = ?, description = ? WHERE id = ?";
        $updateFlowerStmt = $conn->prepare($updateFlowerSql);
        $updateFlowerStmt->bind_param("sssi", $name, $category, $description, $productId);
        $updateFlowerStmt->execute();

        $updateSizeSql = "UPDATE flower_sizes SET price = ? WHERE flower_id = ? AND size = ?";
        $updateSizeStmt = $conn->prepare($updateSizeSql);
        $updateSizeStmt->bind_param("dis", $price, $productId, $selectedSize);
        $updateSizeStmt->execute();

        $updateSizeSql = "UPDATE flower_sizes SET quantity = ? WHERE flower_id = ? AND size = ?";
        $updateSizeStmt = $conn->prepare($updateSizeSql);
        $updateSizeStmt->bind_param("dis", $quantity, $productId, $selectedSize);
        $updateSizeStmt->execute();

        echo "<script>
                alert('Product updated successfully!');
                window.location.href = window.location.href;
            </script>";
        exit;
    } elseif (isset($_POST['delete'])) {
     
        $deleteSql = "DELETE FROM flowers WHERE id = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param("i", $productId);
        if ($deleteStmt->execute()) {
            echo "<script>
                    alert('Product deleted successfully!');
                    window.location.href = 'AllProducts.php';
                  </script>";
            exit;
        } else {
            echo "<script>alert('Error deleting product.');</script>";
        }
    }
}
?>

<?php include('../includes/adminMenu.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/FlowerSHOP/css/OneProduct.css">
    <title>One Product</title>
</head>
<body>
    <div class="container">
        <div class="EditProduct">
            <?php 
            include('../includes/AddNewSize.php');
            ?>

            <form method="POST" enctype="multipart/form-data" class="FormClass">
                <label for="name">Product Name:</label>
                <input type="text" name="name" value="<?php echo $flower['name']; ?>" required>

                <label for="category">Category:</label>
                <select name="category" required>
                    <?php foreach ($categories as $cat) { ?>
                        <option value="<?php echo $cat; ?>" <?php if ($cat == $flower['category']) echo 'selected'; ?>>
                            <?php echo $cat; ?>
                        </option>
                    <?php } ?>
                </select>

                <label for="description">Description:</label>
                <textarea name="description" required><?php echo $flower['description']; ?></textarea>

                <label>Size, Price & Quantity:</label>
                <?php if (!empty($sizes)) { 
                    $firstSize = key($sizes);
                    $firstPrice = $sizes[$firstSize]['price'];
                    $firstQuantity = $sizes[$firstSize]['quantity'];
                ?>
                    <div>
                        <?php foreach ($sizes as $size => $data) { ?>
                            <label>
                                <input type="radio" name="size" value="<?php echo $size; ?>" required <?php if ($size == $firstSize) echo 'checked'; ?>>
                                <?php echo $size; ?>
                            </label>
                        <?php } ?>
                    </div>
                    <input type="text" name="price" id="priceInput" value="<?php echo number_format($firstPrice, 2); ?>" required>
                    <input type="text" name="quantity" id="quantityInput" value="<?php echo $firstQuantity; ?>" required>
                <?php } else { ?>
                    <p>No sizes available for this product.</p>
                <?php } ?>
        
                <div class="buttons">
                    <button type="submit" name="update">Update</button>
                    <button type="submit" name="delete" style="background-color: red;">Delete</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const flowerId = <?php echo $productId; ?>;
        const prices = <?php echo json_encode($sizes); ?>;
    </script>
    <script src="/FlowerSHOP/js/update_product.js"></script>
</body>
</html>

<?php
$conn->close();
?>
