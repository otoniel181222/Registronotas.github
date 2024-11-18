<?php
// Iniciar sesión al principio del archivo
session_start();

// Si el usuario hace clic en "Cerrar sesión"
if (isset($_GET['cerrar_sesion'])) {
    // Destruir la sesión
    session_unset();  // Elimina todas las variables de sesión
    session_destroy(); // Destruye la sesión

    // Redirigir a la página de inicio de sesión o cualquier otra página
    header("Location: ver_notas.php");
    exit;
}
?>
