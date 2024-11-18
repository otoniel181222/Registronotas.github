<?php
// Incluye tu archivo de conexión a la base de datos
include 'includes_db.php';

// Validar que el formulario haya sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos del formulario
    $dni = $_POST['dni'];
    $nombre_alumno = $_POST['nombre_alumno'];
    $curso = $_POST['curso'];
    $nota = $_POST['nota'];
    $fecha = $_POST['fecha'];
    $grado = $_POST['grado'];
    $seccion = $_POST['seccion'];

    // Verificar que no haya campos vacíos (opcional pero recomendable)
    if (!empty($dni) && !empty($nombre_alumno) && !empty($curso) && !empty($nota) && !empty($fecha) && !empty($grado) && !empty($seccion)) {
        // Preparar la consulta SQL para insertar los datos
        $sql = "INSERT INTO nota (dni, nombre_alumno, curso, nota, fecha, grado, seccion)
                VALUES (:dni, :nombre_alumno, :curso, :nota, :fecha, :grado, :seccion)";
        $stmt = $pdo->prepare($sql);
        
        // Ejecutar la consulta con los datos proporcionados
        if ($stmt->execute([
            ':dni' => $dni,
            ':nombre_alumno' => $nombre_alumno,
            ':curso' => $curso,
            ':nota' => $nota,
            ':fecha' => $fecha,
            ':grado' => $grado,
            ':seccion' => $seccion
        ])) {
            echo "Nota agregada correctamente.";
        } else {
            echo "Error al agregar la nota.";
        }
    } else {
        echo "Por favor, completa todos los campos.";
    }
}
?>
