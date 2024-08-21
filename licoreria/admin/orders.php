<?php
include('../config/db.php');
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$sql = "SELECT o.id, u.username, o.total_amount, o.status, o.created_at 
        FROM orders o 
        JOIN users u ON o.user_id = u.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Administrar Órdenes</title>
</head>
<body>
    <h2>Órdenes de Clientes</h2>
    <a href="../index.php">Volver al Inicio</a>
    <table>
        <tr>
            <th>ID de Orden</th>
            <th>Cliente</th>
            <th>Total</th>
            <th>Estado</th>
            <th>Fecha</th>
            <th>Acción</th>
        </tr>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['total_amount']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td>
                <a href="order_details.php?id=<?php echo $row['id']; ?>">Ver Detalles</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
