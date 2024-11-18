<?php
// Configuración de la base de datos
$host = 'localhost';
$dbname = 'otoniel2';
$username = 'otoniel2';  // Por defecto en XAMPP/MAMP es 'root' sin contraseña
$password = '123';

try {
    // Crear una nueva conexión PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Registrar el error en un archivo de log en lugar de mostrarlo
    error_log("Error de conexión: " . $e->getMessage());
    echo "Error de conexión: " . $e->getMessage();
}
?>
