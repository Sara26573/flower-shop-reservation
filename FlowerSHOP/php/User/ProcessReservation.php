<?php
session_start();
include('../includes/db.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = intval($_POST['user_id']);
    $flower_id = intval($_POST['flower_id']);
    $size = $_POST['size'];
    $quantity = intval($_POST['quantity']);
    $comments = $_POST['comments'];
    $reservation_date = $_POST['reservation_date'];

    $query = $conn->prepare("SELECT price, quantity FROM flower_sizes WHERE flower_id = ? AND size = ?");
    $query->bind_param("is", $flower_id, $size);
    $query->execute();
    $result = $query->get_result();
    $sizeData = $result->fetch_assoc();

    if (!$sizeData || $sizeData['quantity'] < $quantity) {
        echo "<script>
                alert('Error: Not enough stock available.');
                window.location.href = 'ReserveProduct.php?id=$flower_id';
              </script>";
        exit();
    }
    

    $total_price = $quantity * $sizeData['price'];

    $insertQuery = $conn->prepare("INSERT INTO reservation_items (user_id, flower_id, size, quantity, total_price, comments, reservation_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $insertQuery->bind_param("iisidss", $user_id, $flower_id, $size, $quantity, $total_price, $comments, $reservation_date);
    if ($insertQuery->execute()) {
        $updateQuery = $conn->prepare("UPDATE flower_sizes SET quantity = quantity - ? WHERE flower_id = ? AND size = ?");
        $updateQuery->bind_param("iis", $quantity, $flower_id, $size);
        $updateQuery->execute();
        echo "<script>
        alert('Reservation successful!');
        window.location.href = 'ReserveProduct.php?id=$flower_id';
    </script>";
    exit();
    } else {
        echo "Error processing reservation.";
    }
}
?>
