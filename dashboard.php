<?php
include 'db.php';
session_start();
if (!isset($_SESSION['usuario_id'])) { header("Location: index.php"); exit; }

$conexion = new mysqli("sql102.infinityfree.com", "if0_42018239", "nohaytruco3", "if0_42018239_if0_42018239_perfumes_db");
$conexion->set_charset("utf8");

if ($conexion->connect_error) { die("Error de conexión: " . $conexion->connect_error); }

$usuario_id = $_SESSION['usuario_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['perfume_id'], $_POST['lista_id'])) {
    $p_id = $conexion->real_escape_string($_POST['perfume_id']);
    $l_id = $conexion->real_escape_string($_POST['lista_id']);
    $conexion->query("INSERT INTO lista_perfumes (usuario_id, perfume_id, lista_id) VALUES ('$usuario_id', '$p_id', '$l_id')");
    header("Location: dashboard.php"); exit;
}

$perfumes = $conexion->query("SELECT * FROM perfumes");
$listas = $conexion->query("SELECT * FROM listas")->fetch_all(MYSQLI_ASSOC);
$relaciones = $conexion->query("SELECT perfume_id, lista_id FROM lista_perfumes WHERE usuario_id='$usuario_id'");
$u_perfumes = [];
while ($row = $relaciones->fetch_assoc()) $u_perfumes[$row['perfume_id']][] = $row['lista_id'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo - La Perfumoteca</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<header>
    <a href="dashboard.php" class="logo-container"></a>
    <nav>
        <a href="dashboard.php" class="active">Catálogo</a>
        <a href="mis_listas.php">Mis Listas</a>
        <a href="perfil.php">Perfil</a>
    </nav>
    <a href="logout.php" class="logout-btn">Cerrar Sesión</a>
</header>
<main class="page-reveal">
    <h1>Colección de Fragancias</h1>
    <div class="grid">
    <?php while ($p = $perfumes->fetch_assoc()): ?>
        <div class="card">
            <div class="card-content">
                <?php 
                    $nombre_img = str_replace(" ", "_", strtolower($p['nombre'])) . ".jpg";
                    $ruta_img = "img/perfumes/" . $nombre_img;
                ?>
                <div class="img-container">
                    <img src="<?php echo $ruta_img; ?>" alt="<?php echo $p['nombre']; ?>" class="perfume-img">
                </div>
                <h3><?php echo $p['nombre']; ?></h3>
            </div>
            <div class="botones">
            <?php foreach ($listas as $l): 
                $dis = (isset($u_perfumes[$p['id']]) && in_array($l['id'], $u_perfumes[$p['id']])) ? 'disabled' : '';
            ?>
                <form action="dashboard.php" method="POST">
                    <input type="hidden" name="perfume_id" value="<?php echo $p['id']; ?>">
                    <input type="hidden" name="lista_id" value="<?php echo $l['id']; ?>">
                    <button type="submit" <?php echo $dis; ?>><?php echo $l['nombre']; ?></button>
                </form>
            <?php endforeach; ?>
            </div>
        </div>
    <?php endwhile; ?>
    </div>
</main>
</body>
</html>