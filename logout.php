<?php
session_start();
session_destroy();

// Cambia 'login.php' por 'index.php' si ese es el nombre de tu archivo de inicio
header("Location: index.php"); 
exit;
?>