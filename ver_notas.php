<?php
session_start(); // Iniciar sesión

// Verificar si el usuario ha solicitado cerrar sesión
if (isset($_GET['cerrar-sesion'])) {
    // Destruir la sesión
    session_unset();  // Elimina todas las variables de sesión
    session_destroy(); // Destruye la sesión

    // Redirigir a la página de inicio de sesión
    header("Location: login.php"); // Redirige a login.php
    exit();
}

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    // Si no está logueado, redirigir a la página de inicio de sesión
    header("Location: login.php");
    exit();
}
// Cerrar sesión
if (isset($_GET['cerrar_sesion'])) {
    session_start();
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}

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
    <title>Notas Registradas</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        header {
            background-color: #ff0000;
            color: white;
            text-align: center;
            padding: 2px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 2px 20px;
        }

        .cerrar-sesion {
            margin-left: 20px; /* Espacio a la izquierda del botón */
            padding: 10px 15px;
            background-color: #ff4d4d; /* Color rojo para el botón */
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
            width: auto;
        }

        .cerrar-sesion:hover {
            background-color: #ff1a1a; /* Color más oscuro al pasar el ratón */
        }

        h1 {
            font-size: 20px; /* Puedes ajustar el tamaño de la fuente aquí */
        }

        .logo {
            width: 60px;
            height: auto;
        }

        main {
            padding: 20px;
            padding-bottom: 60px; /* Espacio adicional en la parte inferior para evitar que la tabla cruce el footer */
            max-width: 1200px;
            margin: auto;
            overflow-x: auto;
        }

        table {
            width: 100%;
            max-width: 1200px;
            margin: 20px auto;
            padding: 10px;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 12px;
            font-size: 16px;
            word-wrap: break-word;
        }

        th {
            background-color: #ff0000;
            color: white;
            font-weight: bold;
        }

        td {
            text-align: center;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
            cursor: pointer;
        }

        @media (max-width: 600px) {
            table {
                width: 100%;
            }
        }

        footer {
            background-color: #ff0000;
            color: white;
            text-align: center;
            padding: 5px 10px;
            position: fixed;
            width: 100%;
            bottom: 0;
            font-size: 14px;
        }

        .footer-image {
            width: 40px;
            height: auto;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Notas Registradas</h1>
        <div style="display: flex; align-items: center;">
        <img src="imagen_logo.png" alt="Logo de la Escuela" class="logo">
        <a href="bienvenida_profesor.php?cerrar-sesion=true" class="cerrar-sesion" onclick="return confirm('¿Seguro que quieres cerrar sesion?');">Cerrar Sesión</a>
        </div>
    </header>
    

    <main>
        <?php
        include 'includes_db.php'; // Asegúrate de que la conexión a la base de datos esté correcta

        // Consultar las notas registradas
        $sql = "SELECT * FROM `nota` ORDER BY fecha DESC";
        $stmt = $pdo->query($sql);
        $notas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Botón para exportar notas
        echo '<a href="exportar_notas.php" class="btn">Exportar Notas a CSV</a>'; // Mover el botón aquí

        if ($notas) {
            echo "<table border='1'>";
            echo "<tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Curso</th>
                    <th>Nota</th>
                    <th>Grado</th>
                    <th>Sección</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>";
            foreach ($notas as $nota) {
                $notaValue = $nota['nota']; // Aquí deberías tener AD, A, B o C
                if (!in_array($notaValue, ['AD', 'A', 'B', 'C'])) {
                    $notaValue = 'No asignada'; // O cualquier otro valor por defecto
                }
                
                echo "<tr>
                    <td>{$nota['dni']}</td>
                    <td>{$nota['nombre_alumno']}</td>
                    <td>{$nota['curso']}</td>
                    <td>{$nota['nota']}</td>
                    <td>{$nota['grado']}</td>
                    <td>{$nota['seccion']}</td>
                    <td>{$nota['fecha']}</td>
                    <td>
                        <a href='editar_nota.php?id={$nota['id']}' class='action-btn'>Editar</a>
                        <form action='borrar_nota.php' method='POST' style='display:inline;'>
                            <input type='hidden' name='id' value='{$nota['id']}'>
                            <button type='submit' class='action-btn delete-btn'>Borrar</button>
                        </form>
                </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No hay notas registradas.</p>";
        }
        ?>
        <a href="index.php" class="btn">Regresar a la página de Registro</a>
    </main>

    <footer>
    <div style="display: flex; align-items: center; justify-content: center;">
        <p>&copy; 2024 IEE JOSE DE SAN MARTIN</p>
        <img src="imagen_logo.png" alt="Imagen de Pie de Página" class="footer-image">
        </div>
    </footer>
</body>
</html>
