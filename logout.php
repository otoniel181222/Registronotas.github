<?php
session_start();
session_destroy(); // Destruir la sesión
header("Location: login_profesor.php"); // Redirigir al inicio de sesión
exit();
?>
