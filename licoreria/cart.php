<?php
include('config/db.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', '$quantity')";
    $conn->query($sql);
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT c.id, p.name, p.price, c.quantity FROM cart c JOIN products p ON c.product_id = p.id WHERE c.user_id = '$user_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <title>Carrito</title>
</head>
<body>
    <h2>Tu Carrito</h2>
    <table>
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Total</th>
            <th>Acción</th>
        </tr>
        <?php
        $total = 0;
        while($row = $result->fetch_assoc()) {
            $total += $row['price'] * $row['quantity'];
        ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td><?php echo $row['price'] * $row['quantity']; ?></td>
            <td><a href="remove_from_cart.php?id=<?php echo $row['id']; ?>">Eliminar</a></td>
        </tr>
        <?php } ?>
    </table>
    <h3>Total: <?php echo $total; ?></h3>
    <form method="post" action="order.php">
        <button type="submit">Realizar Pedido</button>
    </form>
</body>
</html>

<?php $conn->close(); ?>
