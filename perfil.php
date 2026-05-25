<?php
include 'db.php';
session_start();
if (!isset($_SESSION['usuario_id'])) { header("Location: index.php"); exit; }

$conexion = new mysqli("sql102.infinityfree.com", "if0_42018239", "nohaytruco3", "if0_42018239_if0_42018239_perfumes_db");
$conexion->set_charset("utf8");

if ($conexion->connect_error) die("Error de conexión: " . $conexion->connect_error);

$usuario_id = $_SESSION['usuario_id'];
$sql = "SELECT nombre, alias, email FROM usuarios WHERE id='$usuario_id'";
$resultado = $conexion->query($sql);
$usuario = $resultado->fetch_assoc();
$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil de Miembro - La Perfumoteca</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <header>
        <a href="dashboard.php" class="logo-container"></a>
        <nav>
            <a href="dashboard.php">Catálogo</a>
            <a href="mis_listas.php">Mis Listas</a>
            <a href="perfil.php" class="active">Perfil</a>
        </nav>
        <a href="logout.php" class="logout-btn">Cerrar Sesión</a>
    </header>
    <main class="page-reveal">
        <div class="profile-wrapper">
            <div class="profile-card">
                <div class="profile-header">
                    <div class="profile-avatar"><?php echo substr($usuario['alias'], 0, 1); ?></div>
                </div>
                <div class="profile-content">
                    <div class="info-group">
                        <label>Nombre de Registro</label>
                        <span><?php echo $usuario['nombre']; ?></span>
                    </div>
                    <div class="info-group">
                        <label>Identificador / Alias</label>
                        <span><?php echo $usuario['alias']; ?></span>
                    </div>
                    <div class="info-group">
                        <label>Dirección de Correo</label>
                        <span><?php echo $usuario['email']; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>