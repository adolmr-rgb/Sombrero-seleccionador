-- crear la base de datos
CREATE DATABASE IF NOT EXISTS sombrero_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE sombrero_db;
--Tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
  id_usuario INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
--Tabla de casas
CREATE TABLE IF NOT EXISTS casas (
  id_casa INT PRIMARY KEY,
  nombre_casa VARCHAR(50) NOT NULL,
  descripcion TEXT
) ENGINE=InnoDB;
--Estas son las 4 casas oficiales con descripción
INSERT INTO casas (id_casa, nombre_casa, descripcion) VALUES
(1, 'Gryffindor', 'Valentía y coraje'),
(2, 'Slytherin', 'Astucia y ambición'),
(3, 'Ravenclaw', 'Sabiduría e ingenio'),
(4, 'Hufflepuff', 'Lealtad y trabajo');
--Tabla de preguntas
CREATE TABLE IF NOT EXISTS preguntas (
  id_pregunta INT AUTO_INCREMENT PRIMARY KEY,
  texto TEXT NOT NULL
) ENGINE=InnoDB;
--Tabla de opciones
CREATE TABLE IF NOT EXISTS opciones (
  id_opcion INT AUTO_INCREMENT PRIMARY KEY,
  id_pregunta INT NOT NULL,
  texto_opcion TEXT NOT NULL,
  id_casa INT NOT NULL,
  FOREIGN KEY (id_pregunta) REFERENCES preguntas(id_pregunta) ON DELETE CASCADE,
  FOREIGN KEY (id_casa) REFERENCES casas(id_casa) ON DELETE CASCADE
) ENGINE=InnoDB;
--Tabla de resultados
CREATE TABLE IF NOT EXISTS resultados (
  id_resultado INT AUTO_INCREMENT PRIMARY KEY,
  id_usuario INT NOT NULL,
  id_casa INT NOT NULL,
  fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE,
  FOREIGN KEY (id_casa) REFERENCES casas(id_casa) ON DELETE CASCADE
) ENGINE=InnoDB;
--Insertar preguntas
INSERT INTO preguntas (texto) VALUES
('Si un objeto pudiera hablar, ¿qué le preguntarías?'),
('¿Qué harías si descubres un portal a otro mundo?'),
('Si pudieras cambiar tu forma por un animal, ¿cuál sería?'),
('¿Qué escogerías como compañero mágico?'),
('Si tuvieras que resolver un misterio imposible, ¿cómo lo harías?');
--Insertar opciones
INSERT INTO opciones (id_pregunta, texto_opcion, id_casa) VALUES
(1, 'Le preguntaría cómo enfrentar el miedo', 1),
(1, 'Le preguntaría cómo conseguir lo que deseo', 2),
(1, 'Le preguntaría todo sobre el conocimiento oculto', 3),
(1, 'Le preguntaría cómo ayudar a los demás', 4),
(2, 'Saltaría sin pensarlo y exploraría', 1),
(2, 'Planearía cuidadosamente cada paso', 2),
(2, 'Investigaré antes de entrar', 3),
(2, 'Llevaría conmigo a alguien que necesite protección', 4),
(3, 'Elegiría un fénix', 1),
(3, 'Elegiría una serpiente', 2),
(3, 'Elegiría un águila', 3),
(3, 'Elegiría un tejón', 4),
(4, 'Un objeto que me dé coraje en la aventura', 1),
(4, 'Un artefacto que me dé poder y control', 2),
(4, 'Un compañero que enseñe y descubra secretos', 3),
(4, 'Un amigo fiel que me acompañe siempre', 4),
(5, 'Actuaría con audacia y valentía', 1),
(5, 'Usaría estrategia y manipulación', 2),
(5, 'Resolvería estudiando y analizando pistas', 3),
(5, 'Protegería a los inocentes mientras busco la verdad', 4);
