<?php
include 'includes_db.php'; // Asegúrate de que este archivo esté en la misma carpeta o ajusta la ruta.

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="notas.csv"');

// Consultar las notas registradas
$sql = "SELECT dni, nombre_alumno, curso, nota, grado, seccion, fecha FROM nota ORDER BY seccion, nombre_alumno";
$stmt = $pdo->query($sql);
$notas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Salida del encabezado del CSV
$output = fopen('php://output', 'w');
fputcsv($output, ['DNI', 'Nombre', 'Curso', 'Nota', 'Grado', 'Seccion', 'Fecha'], ';'); // Encabezados

// Salida de los datos
foreach ($notas as $nota) {
    fputcsv($output, [
        $nota['dni'],             // DNI en la primera columna
        $nota['nombre_alumno'],   // Nombre en la segunda columna
        $nota['curso'],           // Curso en la tercera columna
        $nota['nota'],            // Nota en la cuarta columna
        $nota['grado'],           // Grado en la quinta columna
        $nota['seccion'],         // Sección en la sexta columna
        $nota['fecha']            // Fecha en la séptima columna
    ], ';');
}

fclose($output);
exit; // Asegúrate de terminar el script aquí
?>
...