<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Si se envió el formulario de inicio de sesión
if (isset($_POST["Inicio"])) {
    // Credenciales correctas
    $_usuario = "JoseDeSanMartin";
    $_email = "josedesanmartin2024@gmail.com";
    $_contrasena = password_hash("jsm2024", PASSWORD_DEFAULT); // Almacena la contraseña hasheada

    // Obtener los valores ingresados en el formulario
    $usuario = htmlspecialchars(trim($_POST["usuario"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $contrasena = $_POST["contrasena"]; // Obtener la contraseña ingresada

    // Validar las credenciales
    if ($_usuario === $usuario && 
        $_email === $email && 
        password_verify($contrasena, $_contrasena)) { // Verificar la contraseña
        
        session_start(); // Iniciar sesión
        $_SESSION['usuario'] = $usuario;
        header("Location: index.php"); // Redirigir al área del profesor
        exit; // Asegúrate de salir después de redirigir
    } else {
        echo "Datos incorrectos, intenta nuevamente.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
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
            font-size: 14px;
        }

        footer {
            background-color: #ff0000;
            color: white;
            text-align: center;
            padding: 10px 20px;
            font-size: 14px;
        }

        main {
            flex-grow: 1;
            padding: 20px;
            text-align: center;
        }

        input[type="text"], input[type="password"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

    </style>
</head>
<body>
    <header>
        <h1>Bienvenido</h1>
        <img src="imagen_logo.png" alt="Logo" class="header-logo">
    </header>
    
    <main>
        <h2>Acceda Los Datos</h2>
        <form method="POST" action="">
            <h3>Iniciar Sesión</h3>
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <button type="submit" name="Inicio">Iniciar Sesión</button>
        </form>
    </main>

    <footer>
        <p>© 2024 IEE JOSE DE SAN MARTIN</p>
        <img src="imagen_logo.png" alt="Logo Footer" class="footer-logo">
    </footer>
</body>
</html>
