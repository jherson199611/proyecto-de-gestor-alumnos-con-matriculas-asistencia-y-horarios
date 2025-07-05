<?php
$host = 'localhost';  // Cambia esto si usas otro servidor
$dbname = 'academia';
$username = 'root';  // Cambia por tu nombre de usuario de MySQL
$password = 'jherson';  // Cambia por tu contraseña de MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error de conexión: ' . $e->getMessage();
}
?>

