<?php
include 'includes_db.php';

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dni = trim($_POST['dni']);
    $nombre_alumno = trim($_POST['nombre_alumno']);
    $curso = trim($_POST['curso']);
    $grado = trim($_POST['grado']);
    $seccion = trim($_POST['seccion']);
    $nota = trim($_POST['nota']);
    $fecha = trim($_POST['fecha']);

    // Validar los datos
    if (!empty($dni) && !empty($nombre_alumno) && !empty($curso) && empty($grado) && !empty($seccion) && !empty($nota) && !empty($fecha)) {
        // Preparar la consulta SQL
        $sql = "INSERT INTO notas (dni, nombre_alumno, curso, nota, grado, seccion, fecha) VALUES (:dni, :nombre_alumno, :curso, :nota, :grado, :seccion, :fecha)";
        $stmt = $pdo->prepare($sql);

        // Vincular los parámetros
        $stmt->bindParam(':dni', $dni, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_alumno', $nombre_alumno, PDO::PARAM_STR);
        $stmt->bindParam(':nota', $nota, PDO::PARAM_STR);
        $stmt->bindParam(':grado', $grado, PDO::PARAM_STR);
        $stmt->bindParam(':seccion', $seccion, PDO::PARAM_STR);
        $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
        $stmt->bindParam(':curso', $curso, PDO::PARAM_STR);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Nota registrada exitosamente.";
        } else {
            echo "Error al registrar la nota.";
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }
}
?>
