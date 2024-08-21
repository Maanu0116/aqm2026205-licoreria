<?php
include('config/db.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

$order_id = $_GET['order_id'];
$sql = "SELECT * FROM orders WHERE id = '$order_id'";
$order = $conn->query($sql)->fetch_assoc();

$sql = "SELECT * FROM order_details WHERE order_id = '$order_id'";
$order_details = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <title>Recibo</title>
</head>
<body>
    <h2>Recibo de Compra</h2>
    <p><strong>ID de Orden:</strong> <?php echo $order['id']; ?></p>
    <p><strong>Total:</strong> <?php echo $order['total_amount']; ?></p>
    <p><strong>Estado:</strong> <?php echo $order['status']; ?></p>
    <h3>Detalles de la Orden</h3>
    <table>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Total</th>
        </tr>
        <?php while($row = $order_details->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['product_id']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['quantity'] * $row['price']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
