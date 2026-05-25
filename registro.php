<?php
include 'db.php';
session_start();
$conexion = new mysqli("sql102.infinityfree.com", "if0_42018239", "nohaytruco3", "if0_42018239_if0_42018239_perfumes_db");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $n = $conexion->real_escape_string($_POST['nombre']);
    $a = $conexion->real_escape_string($_POST['alias']);
    $e = $conexion->real_escape_string($_POST['email']);
    $p = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if ($conexion->query("INSERT INTO usuarios (nombre, alias, email, password) VALUES ('$n', '$a', '$e', '$p')")) {
        header("Location: index.php"); exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body class="auth-body">
    <div class="form-container page-reveal">
        <h1>Registro</h1>
        <form action="registro.php" method="POST">
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="text" name="alias" placeholder="Alias" required>
            <input type="email" name="email" placeholder="Correo" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Registrarse</button>
        </form>
        <a href="index.php">¿Ya tienes cuenta? Iniciar Sesión</a>
    </div>
</body>
</html>