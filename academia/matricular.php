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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $curso_id = $_POST['curso_id'];

    // Registrar estudiante
    $stmt = $pdo->prepare("INSERT INTO estudiantes (nombre, email, telefono) VALUES (?, ?, ?)");
    $stmt->execute([$nombre, $email, $telefono]);
    $estudiante_id = $pdo->lastInsertId();

    // Registrar matrícula
    $stmt = $pdo->prepare("INSERT INTO matriculas (estudiante_id, curso_id) VALUES (?, ?)");
    $stmt->execute([$estudiante_id, $curso_id]);

    echo "<p style='color: green;'>Matrícula registrada con éxito.</p>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Matrícula</title>
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
        input[type="text"], input[type="email"], select {
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
        <h2>Formulario de Matrícula</h2>
        <form method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono">

            <label for="curso_id">Curso:</label>
            <select id="curso_id" name="curso_id" required>
                <?php foreach ($cursos as $curso): ?>
                    <option value="<?= $curso['id'] ?>"><?= $curso['nombre_curso'] ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Matricular</button>
        </form>

        <!-- Botón para ir al menú -->
        <a href="menu.php">
            <button class="menu-button">Ir al Menú</button>
        </a>
    </div>

</body>
</html>
