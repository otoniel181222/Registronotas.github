<?php
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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Notas de Alumno</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Registrar Notas de Alumno</h1>
        <img src="imagen_logo.png" alt="Logo de la Escuela" class="logo">
    </header>

    <main>
        <form method="post" action="index.php">
            <label for="dni">ID del Alumno :</label>
            <input type="number" id="dni" name="dni" min="10000000" max="99999999" required><br><br>

            <label for="nombre_alumno">Nombre del Alumno:</label>
            <input type="text" id="nombre_alumno" name="nombre_alumno" required><br><br>

            <label for="curso">Curso:</label>
            <select id="curso" name="curso" required>
                <option value="">Seleccione un curso</option>
                <option value="MATEMATICA">MATEMATICA</option>
                <option value="COMUNICACION">COMUNICACION</option>
                <option value="CIENCIASS SOCIALES">CIENCIAS SOCIALES</option>
                <option value="DPCC">DPCC</option>
                <option value="CIENCIA Y TECNOLOGIA">CIENCIA Y TECNOLOGIA</option>
                <option value="INGLES">INGLES</option>
                <option value="EPT">EPT</option>
                <option value="E.FISICA">E.FISICA</option>
                <option value="E.RELIGIOSA">E.RELIGIOSA</option>
                <option value="ARTE Y CULTURA">ARTE Y CULTURA</option>
            </select><br><br>

            <label for="nota">Nota:</label>
            <select id="nota" name="nota" required>
            <option value="">Seleccione una nota</option>
                <option value="AD">AD</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
            </select><br><br>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" required><br><br>

            <label for="grado">Grado:</label>
            <select id="grado" name="grado" required>
                <option value="">Seleccione un grado</option>
                <option value="PRIMERO">PRIMERO</option>
                <option value="SEGUNDO">SEGUNDO</option>
                <option value="TERCERO">TERCERO</option>
                <option value="CUARTO">CUARTO</option>
                <option value="QUINTO">QUINTO</option>
            </select><br><br>

            <label for="seccion">Sección:</label>
            <select id="seccion" name="seccion" required>
                <option value="">Seleccione una sección</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                <option value="F">F</option>
                <option value="F">G</option>
                <option value="F">H</option>
            </select><br><br>

            <input type="submit" value="Registrar Nota">

            <a href="ver_notas.php" class="btn">Ver Notas Registradas</a>
        </form>

        <div class="message">
        <?php
        include 'includes_db.php'; // Asegúrate de que la conexión a la base de datos esté correcta

        // Verificar si el formulario ha sido enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $dni = $_POST['dni'];
            $nombre_alumno = $_POST['nombre_alumno'];
            $curso = $_POST['curso'];
            $grado = $_POST['grado'];
            $seccion = $_POST['seccion'];
            $nota = $_POST['nota'];
            $fecha = $_POST['fecha'];

            // Validar los datos
            if (!empty($dni) && !empty($nombre_alumno) && !empty($curso) && !empty($grado) && !empty($seccion) && !empty($nota) && !empty($fecha)) {
                // Preparar la consulta SQL
                $sql = "INSERT INTO nota (dni, nombre_alumno, curso, nota, grado, seccion, fecha) VALUES (:dni, :nombre_alumno, :curso, :nota, :grado, :seccion, :fecha)";
                $stmt = $pdo->prepare($sql);

                // Vincular los parámetros
                $stmt->bindParam(':dni', $dni, PDO::PARAM_INT);
                $stmt->bindParam(':nombre_alumno', $nombre_alumno, PDO::PARAM_STR);
                $stmt->bindParam(':curso', $curso, PDO::PARAM_STR);
                $stmt->bindParam(':grado', $grado, PDO::PARAM_STR);
                $stmt->bindParam(':seccion', $seccion, PDO::PARAM_STR);
                $stmt->bindParam(':nota', $nota, PDO::PARAM_STR);
                $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);

                // Ejecutar la consulta
                if ($stmt->execute()) {
                    echo "<p>Nota registrada exitosamente.</p>";
                    header("Location: resumen_notas.php");  // Redirigir al resumen de notas
                    exit();
                } else {
                    echo "<p>Error al registrar la nota.</p>";
                }
            } else {
                echo "<p>Todos los campos son obligatorios.</p>";
            }
        }
        ?>
        </div>
    </main>

    <footer>
    <div class="footer-content">
        <p>&copy; 2024 IEE JOSE DE SAN MARTIN</p>
        <img src="imagen_logo.png" alt="Imagen de Pie de Página" class="footer-image">
        </div>
    </footer>
</body>
</html>
