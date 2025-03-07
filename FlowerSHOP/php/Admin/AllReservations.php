<?php

include('../includes/db.php');
include('../includes/adminMenu.php');

$sql = "
    SELECT 
        f.name AS flower_name, 
        f.category AS flower_category, 
        u.id AS user_id, 
        u.name AS user_name, 
        u.surname AS user_surname, 
        u.email AS user_email, 
        u.phoneNumber AS user_phone, 
        r.size, 
        r.quantity, 
        r.total_price, 
        r.comments, 
        r.reservation_date
    FROM 
        reservation_items r
    LEFT JOIN 
        User u ON r.user_id = u.id
    LEFT JOIN 
        flower_sizes fs ON r.flower_id = fs.flower_id AND r.size = fs.size
    JOIN 
        flowers f ON r.flower_id = f.id
";

$result = $conn->query($sql);  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/FlowerSHOP/css/AllReservations.css"> 
    <title>Reservation Details</title>
</head>
<body>
<div class="container">
<table>
    <thead>
        <tr>
            <th>Flower Name</th>
            <th>Category</th>
            <th>User Name</th>
            <th>User Surname</th>
            <th>User Email</th>
            <th>User Phone</th>
            <th>Size</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Comments</th>
            <th>Reservation Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
           
            while($row = $result->fetch_assoc()) {
                echo "<tr onclick='fillFields(this)'>";
                echo "<td>" . $row['flower_name'] . "</td>";
                echo "<td>" . $row['flower_category'] . "</td>";
                echo "<td>" . $row['user_name'] . "</td>";
                echo "<td>" . $row['user_surname'] . "</td>";
                echo "<td>" . $row['user_email'] . "</td>";
                echo "<td>" . $row['user_phone'] . "</td>";
                echo "<td>" . $row['size'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td>" . $row['total_price'] . "</td>";
                echo "<td>" . $row['comments'] . "</td>";
                echo "<td>" . $row['reservation_date'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='11'>No data found</td></tr>";
        }
        ?>
    </tbody>
</table>

<div>
    <form id="reservationForm">
        <label for="flowerName">Flower Name: </label><input type="text" id="flowerName" readonly><br>
        <label for="flowerCategory">Category: </label><input type="text" id="flowerCategory" readonly><br>
        <label for="userName">User Name: </label><input type="text" id="userName" readonly><br>
        <label for="userSurname">User Surname: </label><input type="text" id="userSurname" readonly><br>
        <label for="userEmail">User Email: </label><input type="text" id="userEmail" readonly><br>
        <label for="userPhone">User Phone: </label><input type="text" id="userPhone" readonly><br>
        <label for="size">Size: </label><input type="text" id="size" readonly><br>
        <label for="quantity">Quantity: </label><input type="number" id="quantity" readonly><br>
        <label for="totalPrice">Total Price: </label><input type="text" id="totalPrice" readonly><br>
        <label for="comments">Comments: </label><textarea id="comments" readonly></textarea><br>
        <label for="reservationDate">Reservation Date: </label><input type="date" id="reservationDate" readonly><br>
    </form>

<div >    
</div>

<script>

    function fillFields(row) {
        document.getElementById("flowerName").value = row.cells[0].innerText;
        document.getElementById("flowerCategory").value = row.cells[1].innerText;
        document.getElementById("userName").value = row.cells[2].innerText;
        document.getElementById("userSurname").value = row.cells[3].innerText;
        document.getElementById("userEmail").value = row.cells[4].innerText;
        document.getElementById("userPhone").value = row.cells[5].innerText;
        document.getElementById("size").value = row.cells[6].innerText;
        document.getElementById("quantity").value = row.cells[7].innerText;
        document.getElementById("totalPrice").value = row.cells[8].innerText;
        document.getElementById("comments").value = row.cells[9].innerText;
        document.getElementById("reservationDate").value = row.cells[10].innerText;
    }
</script>

</body>
</html>

<?php
$conn->close();
?>
