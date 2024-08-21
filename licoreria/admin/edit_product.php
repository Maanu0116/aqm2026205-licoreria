<?php
include('../config/db.php');
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if (!$product) {
        echo "Producto no encontrado.";
        exit();
    }
} else {
    echo "ID de producto no especificado.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $sql = "UPDATE products SET name = ?, description = ?, price = ?, stock = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdii", $name, $description, $price, $stock, $id);

    if ($stmt->execute()) {
        header("Location: manage_products.php");
        exit();
    } else {
        echo "Error al actualizar el producto.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title>Editar Producto</title>
</head>
<body>
    <h2>Editar Producto</h2>
    <form method="POST">
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required><br>
        <label for="description">Descripción:</label>
        <textarea id="description" name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea><br>
        <label for="price">Precio:</label>
        <input type="number" id="price" name="price" step="0.01" value="<?php echo htmlspecialchars($product['price']); ?>" required><br>
        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" value="<?php echo htmlspecialchars($product['stock']); ?>" required><br>
        <input type="submit" value="Actualizar Producto">
    </form>
    <a href="manage_products.php">Volver a la lista</a>
</body>
</html>

<?php $conn->close(); ?>
