<?php
include('config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = 'client';

    $sql = "INSERT INTO users (username, password, email, role) VALUES ('$username', '$password', '$email', '$role')";
    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <title>Registro</title>
</head>
<body>
    <form method="post" action="register.php">
        <h2>Registro</h2>
        <label>Nombre de Usuario:</label><br>
        <input type="text" name="username" required><br>
        <label>Email:</label><br>
        <input type="email" name="email" required><br>
        <label>Contraseña:</label><br>
        <input type="password" name="password" required><br>
        <button type="submit">Registrarse</button>
    </form>
</body>
</html>
