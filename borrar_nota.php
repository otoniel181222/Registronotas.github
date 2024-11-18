<?php
include 'includes_db.php'; // Asegúrate de que la conexión a la base de datos esté correcta

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    try {
        // Verificar si el ID es válido
        if (!empty($id)) {
            // Consulta para eliminar la nota
            $sql = "DELETE FROM `nota` WHERE id = :id"; // Cambia 'WHERE 0' a 'WHERE id = :id'
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':id' => $id]); // Usa ':id' como marcador de posición

            // Redirigir después de borrar
            header("Location: ver_notas.php"); // Redirigir a la página de notas después de borrar
            exit();
        } else {
            echo "ID inválido."; // Manejo simple de error si el ID no es válido
        }
    } catch (PDOException $e) {
        echo "Error al eliminar la nota: " . $e->getMessage(); // Mostrar mensaje de error
    }
}
?>
