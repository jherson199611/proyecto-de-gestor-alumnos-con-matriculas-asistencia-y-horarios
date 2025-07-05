<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

include('db.php');

// Obtener lista de cursos
$stmt = $pdo->query("SELECT * FROM cursos");
$cursos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos Disponibles</title>
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
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%;
            text-align: center;
        }
        h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ccc;
        }
        th {
            background-color: #333;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }
        button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Cursos Disponibles</h2>
        <table>
            <thead>
                <tr>
                    <th>Curso</th>
                    <th>Descripción</th>
                    <th>Duración (horas)</th>
                    <th>Horario</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cursos as $curso): ?>
                    <tr>
                        <td><?= $curso['nombre_curso'] ?></td>
                        <td><?= $curso['descripcion'] ?></td>
                        <td><?= $curso['duracion'] ?> horas</td>
                        <td><?= $curso['horario_inicio'] ?> - <?= $curso['horario_fin'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Botón para ir al menú -->
        <a href="menu.php">
            <button>Ir al Menú</button>
        </a>
    </div>

</body>
</html>
