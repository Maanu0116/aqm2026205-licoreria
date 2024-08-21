<?php
include('config/db.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT SUM(p.price * c.quantity) AS total_amount FROM cart c JOIN products p ON c.product_id = p.id WHERE c.user_id = '$user_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_amount = $row['total_amount'];

$sql = "INSERT INTO orders (user_id, total_amount, status) VALUES ('$user_id', '$total_amount', 'pending')";
if ($conn->query($sql) === TRUE) {
    $order_id = $conn->insert_id;

    $sql = "SELECT * FROM cart WHERE user_id = '$user_id'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $product_id = $row['product_id'];
        $quantity = $row['quantity'];
        $price = $row['price'];

        $sql = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES ('$order_id', '$product_id', '$quantity', '$price')";
        $conn->query($sql);
    }

    $sql = "DELETE FROM cart WHERE user_id = '$user_id'";
    $conn->query($sql);

    header("Location: receipt.php?order_id=$order_id");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
