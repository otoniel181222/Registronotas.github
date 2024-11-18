<?php
include 'includes_db.php'; // Asegúrate de que la conexión a la base de datos esté correcta

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger datos del formulario
    $id = $_POST['id'];
    $dni = $_POST['dni'];
    $nombre_alumno = $_POST['nombre_alumno'];
    $curso = $_POST['curso'];
    $nota = $_POST['nota'];
    $grado = $_POST['grado'];
    $seccion = $_POST['seccion'];
    $fecha = $_POST['fecha'];

    // Consulta para actualizar la nota
    $sql = "UPDATE nota SET 
                dni = :dni, 
                nombre_alumno = :nombre_alumno, 
                curso = :curso, 
                nota = :nota, 
                grado = :grado, 
                seccion = :seccion, 
                fecha = :fecha 
            WHERE id = :id";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'dni' => $dni,
        'nombre_alumno' => $nombre_alumno,
        'curso' => $curso,
        'nota' => $nota,
        'grado' => $grado,
        'seccion' => $seccion,
        'fecha' => $fecha,
        'id' => $id
    ]);

    // Redirigir después de editar
    header("Location: ver_notas.php");
    exit();
}

// Si se accede a la página por GET, se muestra el formulario para editar
$id = $_GET['id'];
$sql = "SELECT * FROM nota WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$nota = $stmt->fetch(PDO::FETCH_ASSOC);

// Comprobar si la nota existe
if (!$nota) {
    echo "Nota no encontrada.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Nota</title>
</head>
<body>
    <h1>Editar Nota</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $nota['id'] ?>">
        DNI: <input type="text" name="dni" value="<?= $nota['dni'] ?>" required><br>
        Nombre: <input type="text" name="nombre_alumno" value="<?= $nota['nombre_alumno'] ?>" required><br>
        Curso: <input type="text" name="curso" value="<?= $nota['curso'] ?>" required><br>
        Nota: 
        <select name="nota" required>
            <option value="AD" <?= $nota['nota'] == 'AD' ? 'selected' : '' ?>>AD</option>
            <option value="A" <?= $nota['nota'] == 'A' ? 'selected' : '' ?>>A</option>
            <option value="B" <?= $nota['nota'] == 'B' ? 'selected' : '' ?>>B</option>
            <option value="C" <?= $nota['nota'] == 'C' ? 'selected' : '' ?>>C</option>
        </select><br>
        Grado: <input type="text" name="grado" value="<?= $nota['grado'] ?>" required><br>
        Sección: <input type="text" name="seccion" value="<?= $nota['seccion'] ?>" required><br>
        Fecha: <input type="date" name="fecha" value="<?= $nota['fecha'] ?>" required><br>
        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>
