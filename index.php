<?php
include 'db.php';
session_start();
$conexion = new mysqli("sql102.infinityfree.com", "if0_42018239", "nohaytruco3", "if0_42018239_if0_42018239_perfumes_db");
$conexion->set_charset("utf8");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conexion->real_escape_string($_POST['email']);
    $res = $conexion->query("SELECT * FROM usuarios WHERE email='$email'");
    if ($res->num_rows == 1) {
        $u = $res->fetch_assoc();
        if (password_verify($_POST['password'], $u['password'])) {
            $_SESSION['usuario_id'] = $u['id'];
            $_SESSION['usuario_alias'] = $u['alias'];
            header("Location: dashboard.php"); exit;
        }
    }
    $_SESSION['mensaje'] = "Credenciales incorrectas.";
    header("Location: index.php"); exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body class="auth-body">
    <div class="form-container page-reveal">
        <h1>Iniciar Sesión</h1>
        <?php if (isset($_SESSION['mensaje'])): ?><p><?php echo $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?></p><?php endif; ?>
        <form action="index.php" method="POST">
            <input type="email" name="email" placeholder="Correo" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Entrar</button>
        </form>
        <a href="registro.php">¿No tienes cuenta? Regístrate</a>
    </div>
</body>
</html>