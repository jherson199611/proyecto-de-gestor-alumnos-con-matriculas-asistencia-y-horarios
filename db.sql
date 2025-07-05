CREATE DATABASE IF NOT EXISTS academia;

USE academia;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO usuarios (username, password) 
VALUES ('admin', SHA2('admin', 256));

INSERT INTO usuarios (username, password) 
VALUES ('jherson', SHA2('jherson', 256));

select * from usuarios;

CREATE TABLE IF NOT EXISTS estudiantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefono VARCHAR(15),
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS cursos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_curso VARCHAR(100) NOT NULL,
    descripcion TEXT,
    duracion INT,  -- Duración en horas
    horario_inicio TIME,
    horario_fin TIME
);
INSERT INTO cursos (nombre_curso, descripcion, duracion, horario_inicio, horario_fin)
VALUES 
    ('Inglés Básico', 'Curso introductorio de inglés', 30, '08:00:00', '10:00:00'),
    ('Francés Intermedio', 'Curso de francés para nivel intermedio', 40, '10:00:00', '12:00:00'),
    ('Alemán Avanzado', 'Curso de alemán para nivel avanzado', 50, '12:00:00', '14:00:00');

INSERT INTO cursos (nombre_curso, descripcion, duracion, horario_inicio, horario_fin)
VALUES ('Ingles Avanzado', 'Curso avanzado de ingles', 20, '15:00:00', '17:00:00'),
	   ('Fisica ', 'Curso basico de fisica', 30, '08:00:00', '10:00:00'),
       ('ciencia de datos', 'curso avanzado de ciencia de datos', 25, '10:00:00', '12:00:00');



CREATE TABLE IF NOT EXISTS matriculas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    estudiante_id INT,
    curso_id INT,
    fecha_matricula TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (estudiante_id) REFERENCES estudiantes(id),
    FOREIGN KEY (curso_id) REFERENCES cursos(id)
);

CREATE TABLE IF NOT EXISTS asistencia (
    id INT AUTO_INCREMENT PRIMARY KEY,
    matricula_id INT,
    fecha DATE,
    presente BOOLEAN,
    FOREIGN KEY (matricula_id) REFERENCES matriculas(id)
);