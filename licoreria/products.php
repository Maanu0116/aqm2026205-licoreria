<?php
include('config/db.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <title>Productos</title>
</head>
<body>
    <h2>Lista de Productos</h2>
    <a href="cart.php">Ver Carrito</a>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Acción</th>
        </tr>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['stock']; ?></td>
            <td>
                <form method="post" action="cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                    <input type="number" name="quantity" min="1" value="1">
                    <button type="submit">Agregar al Carrito</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
