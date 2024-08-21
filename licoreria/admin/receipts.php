<?php
include('../config/db.php');
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$sql = "SELECT r.id, o.id as order_id, u.username, r.total, r.payment_method, r.change_given, r.created_at 
        FROM receipts r 
        JOIN orders o ON r.order_id = o.id
        JOIN users u ON o.user_id = u.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Administrar Recibos</title>
</head>
<body>
    <h2>Recibos Generados</h2>
    <a href="../index.php">Volver al Inicio</a>
    <table>
        <tr>
            <th>ID de Recibo</th>
            <th>ID de Orden</th>
            <th>Cliente</th>
            <th>Total</th>
            <th>Método de Pago</th>
            <th>Cambio</th>
            <th>Fecha</th>
        </tr>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['order_id']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['total']; ?></td>
            <td><?php echo $row['payment_method']; ?></td>
            <td><?php echo $row['change_given']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
