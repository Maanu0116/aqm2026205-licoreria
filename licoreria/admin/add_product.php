<?php
include('../config/db.php');
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $sql = "INSERT INTO products (name, description, price, stock) VALUES ('$name', '$description', '$price', '$stock')";

    if ($conn->query($sql) === TRUE) {
        header("Location: products.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Agregar Producto</title>
</head>
<body>
    <h2>Agregar Nuevo Producto</h2>
    <form method="POST" action="add_product.php">
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" required>

        <label for="description">Descripción:</label>
        <input type="text" id="description" name="description" required>

        <label for="price">Precio:</label>
        <input type="number" id="price" name="price" step="0.01" required>

        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" required>

        <button type="submit">Agregar Producto</button>
    </form>
    <a href="products.php">Volver a la lista de productos</a>
</body>
</html>
