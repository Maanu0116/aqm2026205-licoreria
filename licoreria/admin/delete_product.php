<?php
include('../config/db.php');
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: manage_products.php");
        exit();
    } else {
        echo "Error al eliminar el producto.";
    }
} else {
    echo "ID de producto no especificado.";
}
?>

<?php $conn->close(); ?>
