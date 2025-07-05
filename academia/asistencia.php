<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

include('db.php');

// Obtener lista de matriculas
$stmt = $pdo->query("SELECT m.id, e.nombre, c.nombre_curso 
                     FROM matriculas m
                     JOIN estudiantes e ON m.estudiante_id = e.id
                     JOIN cursos c ON m.curso_id = c.id");
$matriculas = $stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matricula_id = $_POST['matricula_id'];
    $fecha = $_POST['fecha'];
    $presente = $_POST['presente'] == '1' ? true : false;

    // Registrar asistencia
    $stmt = $pdo->prepare("INSERT INTO asistencia (matricula_id, fecha, presente) VALUES (?, ?, ?)");
    $stmt->execute([$matricula_id, $fecha, $presente]);

    echo "<p style='color: green;'>Asistencia registrada con éxito.</p>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Asistencia</title>
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
        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        h2 {
            color: #333;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }
        input[type="text"], input[type="email"], select, input[type="date"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
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
        }
        button:hover {
            background-color: #555;
        }
        .menu-button {
            width: 100%;
            padding: 10px;
            background-color: #555;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }
        .menu-button:hover {
            background-color: #333;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Registrar Asistencia</h2>
        <form method="POST">
            <label for="matricula_id">Estudiante:</label>
            <select id="matricula_id" name="matricula_id" required>
                <?php foreach ($matriculas as $matricula): ?>
                    <option value="<?= $matricula['id'] ?>"><?= $matricula['nombre'] ?> - <?= $matricula['nombre_curso'] ?></option>
                <?php endforeach; ?>
            </select>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" required>

            <label for="presente">Asistio?</label><br>
            <input type="radio" id="presente" name="presente" value="1" required> Sí
            <input type="radio" id="ausente" name="presente" value="0" required> No<br><br>

            <button type="submit">Registrar Asistencia</button>
        </form>

        <!-- Botón para ir al menú -->
        <a href="menu.php">
            <button class="menu-button">Ir al Menú</button>
        </a>
    </div>

</body>
</html>
