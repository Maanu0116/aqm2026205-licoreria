<?php
include('config/db.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        $row = $result->fetch_assoc();
        $_SESSION['role'] = $row['role'];
        if ($_SESSION['role'] == 'admin') {
            header("Location: admin/products.php");
        } else {
            header("Location: products.php");
        }
    } else {
        echo "Nombre de usuario o contraseña incorrectos";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <title>Login</title>
</head>
<body>
    <form method="post" action="login.php">
        <h2>Iniciar Sesión</h2>
        <label>Nombre de Usuario:</label><br>
        <input type="text" name="username" required><br>
        <label>Contraseña:</label><br>
        <input type="password" name="password" required><br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
