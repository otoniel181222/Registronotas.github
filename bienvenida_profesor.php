<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    // Si no está logueado, redirigir a la página de inicio de sesión
    header("Location: login.php");
    exit();
}

// Aquí va el contenido de la página bienvenida_profesor.php
// Verificar si el usuario ha solicitado cerrar sesión
if (isset($_GET['cerrar-sesion'])) {
    // Destruir la sesión
    session_unset();  // Elimina todas las variables de sesión
    session_destroy(); // Destruye la sesión

    // Redirigir al formulario de inicio de sesión o a la página de inicio
    header("Location: login.php"); // Redirige a login.php
    exit();
}

// Verificar si el usuario está logueado

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
    <title>Bienvenida Profesor</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #ff0000;
            color: white;
            text-align: center;
            padding: 10px 20px;
        }

        footer {
            background-color: #ff0000;
            color: white;
            text-align: center;
            padding: 10px 20px;
        }

        main {
            flex-grow: 1;
            padding: 20px;
            text-align: center;
        }

        .cerrar-sesion {
            color: red;
            text-decoration: none;
            font-weight: bold;
        }

    </style>
</head>
<body>
    <header>
        <h1>Bienvenido, <?php echo $_SESSION['usuario']; ?></h1>
    </header>
    
    <main>
        <h2>¡Bienvenido a la plataforma del profesor!</h2>
        <p>Aquí puedes acceder a todas las funcionalidades del sistema.</p>

        <!-- Enlace para cerrar sesión -->
        <a href="ver_notas.php?cerrar-sesion=true" class="cerrar-sesion" onclick="return confirm('¿Seguro que quieres cerrar sesión?');">Cerrar Sesión</a>
    </main>

    <footer>
        <p>© 2024 IEE JOSE DE SAN MARTIN</p>
    </footer>
</body>
</html>
