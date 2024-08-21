<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Licorería - Página Principal</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            color: #333;
        }

        header {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        .user-info {
            font-size: 16px;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container a {
            display: block;
            padding: 15px;
            margin: 15px 0;
            text-decoration: none;
            color: #fff;
            background-color: #4CAF50;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .container a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>Bienvenido a la Licorería</h1>
        <?php if (isset($_SESSION['username'])): ?>
            <div class="user-info">
                <p>Hola, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
            </div>
        <?php endif; ?>
    </header>

    <div class="container">
        <?php if (isset($_SESSION['username'])): ?>
            <a href="products.php">Ver Productos</a>
            <a href="cart.php">Ver Carrito</a>
            <?php if ($_SESSION['role'] == 'admin'): ?>
                <a href="admin/products.php">Administrar Productos</a>
                <a href="admin/orders.php">Ver Órdenes</a>
                <a href="admin/receipts.php">Ver Recibos</a>
            <?php endif; ?>
            <a href="logout.php">Cerrar Sesión</a>
        <?php else: ?>
            <a href="login.php">Iniciar Sesión</a>
            <a href="register.php">Registrarse</a>
        <?php endif; ?>
    </div>
</body>
</html>
