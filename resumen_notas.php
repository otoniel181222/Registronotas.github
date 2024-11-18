<?php
include 'includes_db.php'; 
session_start();

// Impedir que la página se almacene en caché
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Consultar todas las notas
$sql = "SELECT nota FROM nota";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$notas = $stmt->fetchAll(PDO::FETCH_COLUMN);

$total_notas = count($notas);
$notas_count = array_count_values($notas);
$nota_promedio = $total_notas > 0 ? array_sum($notas_count) / $total_notas : 0;

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen de Notas</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Resumen de Notas</h1>
        <img src="imagen_logo.png" alt="Logo de la Escuela" class="logo">
    </header>

    <main>
        <h2>Estadísticas de Notas</h2>
        <p>Total de Notas Registradas: <?php echo $total_notas; ?></p>
        <p>Nota Promedio: <?php echo number_format($nota_promedio, 2); ?></p>
        
        <h3>Distribución de Notas</h3>
        <ul>
            <?php foreach (['AD', 'A', 'B', 'C'] as $nota): ?>
                <li><?php echo $nota; ?>: 
                    <?php 
                    $porcentaje = isset($notas_count[$nota]) ? ($notas_count[$nota] / $total_notas) * 100 : 0;
                    echo number_format($porcentaje, 2) . '%';
                    ?>
                </li>
            <?php endforeach; ?>
        </ul>
        
        <a href="index.php" class="btn">Registrar Nueva Nota</a> <!-- Enlace para regresar al formulario -->
        <a href="ver_notas.php" class="btn">Ver Notas Registradas</a> <!-- Enlace para ver todas las notas -->
    </main>

    <footer>
        <p>&copy; 2024 IEE JOSE DE SAN MARTIN</p>
        <img src="imagen_logo.png" alt="Imagen de Pie de Página" class="footer-image">
    </footer>
</body>
</html>
