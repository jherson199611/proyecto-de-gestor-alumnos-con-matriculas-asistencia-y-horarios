<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .menu-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        h2 {
            color: #333;
        }
        p {
            margin: 15px 0;
        }
        a {
            color: #333;
            text-decoration: none;
            font-size: 18px;
            padding: 10px;
            display: block;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        a:hover {
            background-color: #333;
            color: white;
        }
        .logout-button {
            background-color: #333;
            color: white;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }
        .logout-button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

    <div class="menu-container">
        <h2>Bienvenido, <?= $_SESSION['usuario'] ?></h2>
        <p><a href="matricular.php">Matricular Estudiantes</a></p>
        <p><a href="asistencia.php">Registrar Asistencia</a></p>
        <p><a href="cursos.php">Ver Cursos</a></p>
        <p><a href="logout.php" class="logout-button">Cerrar sesión</a></p>
    </div>

</body>
</html>
