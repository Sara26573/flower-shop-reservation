<?php

$existingSizes = array_keys($sizes); 

$availableSizes = ['S', 'M', 'L'];

$remainingSizes = array_diff($availableSizes, $existingSizes);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addSize'])) {
    if (!empty($_POST['newSize']) && !empty($_POST['newSizePrice'])) {
        $newSize = $_POST['newSize'];
        $newPrice = $_POST['newSizePrice'];

        $insertSizeSql = "INSERT INTO flower_sizes (flower_id, size, price) VALUES (?, ?, ?)";
        $insertSizeStmt = $conn->prepare($insertSizeSql);
        $insertSizeStmt->bind_param("isd", $productId, $newSize, $newPrice);

        if ($insertSizeStmt->execute()) {
            echo "<script>
                    alert('New size added successfully!');
                    window.location.href = window.location.href;
                  </script>";
            exit;
        } else {
            echo "<script>alert('Error adding new size.');</script>";
        }
    } else {
        echo "<script>alert('Please select a size and provide a price.');</script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteSize'])) {
    if (!empty($_POST['sizeToDelete'])) {
        $sizeToDelete = $_POST['sizeToDelete'];

        $deleteSizeSql = "DELETE FROM flower_sizes WHERE flower_id = ? AND size = ?";
        $deleteSizeStmt = $conn->prepare($deleteSizeSql);
        $deleteSizeStmt->bind_param("is", $productId, $sizeToDelete);

        if ($deleteSizeStmt->execute()) {
            echo "<script>
                    alert('Size deleted successfully!');
                    window.location.href = window.location.href;
                  </script>";
            exit;
        } else {
            echo "<script>alert('Error deleting size.');</script>";
        }
    } else {
        echo "<script>alert('Please select a size to delete.');</script>";
    }
}
?>

<div class="product-detail-box">
    <?php ?>
        <img src="/FlowerSHOP/php/uploads/<?php echo $flower['image']; ?>" alt="Product Image">
    <?php ?>


<div class = "BothForms">
    <form method="POST" class="FormClass NewSize">
    <h4>Add new size & price:</h4>
        <label for="newSize">Choose size:</label>
        <select name="newSize" required>
            <?php foreach ($remainingSizes as $size) { ?>
                <option value="<?php echo $size; ?>">
                    <?php echo $size; ?>
                </option>
            <?php } ?>
        </select>
        
        <label for="newSizePrice">Enter price for new size:</label>
        <input type="text" name="newSizePrice" required>
        <button type="submit" name="addSize" style = "margin-top:-5px; width:40%; font-size:14px;">Add Size</button>


    </form>
    <form method="POST" class="FormClass">
        
        <h4>Delete Size for Product</h4>
                <label for="sizeToDelete">Select size to delete:</label>
                <select name="sizeToDelete" required>
                    <?php foreach ($existingSizes as $size) { ?>
                        <option value="<?php echo $size; ?>">
                            <?php echo $size; ?>
                        </option>
                    <?php } ?>
                </select>


                <button type="submit" name="deleteSize" style = " background-color: red;
                                                                  margin-top:-5px;  
                                                                  width:40%;
                                                                  font-size:14px;
                                                                
                                                                     ">Delete Size</button>
    </form>
     </div>

</div>
