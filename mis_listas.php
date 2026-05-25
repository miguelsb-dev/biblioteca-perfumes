<?php
include 'db.php';
session_start();
if (!isset($_SESSION['usuario_id'])) { header("Location: index.php"); exit; }

$conexion = new mysqli("sql102.infinityfree.com", "if0_42018239", "nohaytruco3", "if0_42018239_if0_42018239_perfumes_db");
$conexion->set_charset("utf8");

if ($conexion->connect_error) die("Error de conexión: " . $conexion->connect_error);

$usuario_id = $_SESSION['usuario_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar'], $_POST['perfume_id'], $_POST['lista_id'])) {
    $conexion->query("DELETE FROM lista_perfumes WHERE usuario_id='$usuario_id' AND perfume_id='".$_POST['perfume_id']."' AND lista_id='".$_POST['lista_id']."'");
    header("Location: mis_listas.php"); exit;
}

$resultado_listas = $conexion->query("SELECT * FROM listas");
$listas_perfumes = [];

while ($lista = $resultado_listas->fetch_assoc()) {
    $lista_id = $lista['id'];
    $resultado_perfumes = $conexion->query("SELECT p.id, p.nombre FROM lista_perfumes lp JOIN perfumes p ON lp.perfume_id=p.id WHERE lp.usuario_id='$usuario_id' AND lp.lista_id='$lista_id'");
    $perfumes = [];
    while ($fila = $resultado_perfumes->fetch_assoc()) $perfumes[] = $fila;
    $listas_perfumes[$lista['nombre']] = ['id' => $lista_id, 'perfumes' => $perfumes];
}
$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Listas - La Perfumoteca</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<header>
    <a href="dashboard.php" class="logo-container"></a>
    <nav>
        <a href="dashboard.php">Catálogo</a>
        <a href="mis_listas.php" class="active">Mis Listas</a>
        <a href="perfil.php">Perfil</a>
    </nav>
    <a href="logout.php" class="logout-btn">Cerrar Sesión</a>
</header>
<main class="page-reveal">
    <h1>Colecciones Curadas</h1>
    <?php foreach($listas_perfumes as $lista_nombre => $lista_info): ?>
        <h2><?php echo $lista_nombre; ?></h2>
        <?php if(count($lista_info['perfumes']) > 0): ?>
            <div class="lista-grid">
            <?php foreach($lista_info['perfumes'] as $perfume): ?>
                <?php $img_path = "img/perfumes/".str_replace(" ", "_", strtolower($perfume['nombre'])).".jpg"; ?>
                <div class="perfume-card">
                    <img src="<?php echo $img_path; ?>" alt="<?php echo $perfume['nombre']; ?>">
                    <p><?php echo $perfume['nombre']; ?></p>
                    <form action="mis_listas.php" method="POST">
                        <input type="hidden" name="perfume_id" value="<?php echo $perfume['id']; ?>">
                        <input type="hidden" name="lista_id" value="<?php echo $lista_info['id']; ?>">
                        <button type="submit" name="eliminar">Eliminar</button>
                    </form>
                </div>
            <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Esta selección está vacía.</p>
        <?php endif; ?>
    <?php endforeach; ?>
</main>
</body>
</html>