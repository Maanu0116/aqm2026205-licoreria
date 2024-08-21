<?php
include('../config/db.php');
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title>Administrar Productos</title>
</head>
<body>
    <h2>Lista de Productos</h2>
    <a href="add_product.php">Agregar Producto</a>
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
                <a href="edit_product.php?id=<?php echo $row['id']; ?>">Editar</a>
                <a href="delete_product.php?id=<?php echo $row['id']; ?>">Eliminar</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
