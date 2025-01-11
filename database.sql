CREATE DATABASE api_db;

USE api_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (name, email) VALUES
('Juan Pérez', 'juan.perez@example.com'),
('María Gómez', 'maria.gomez@example.com'),
('Carlos Rodríguez', 'carlos.rodriguez@example.com'),
('Ana Torres', 'ana.torres@example.com'),
('Pedro Sánchez', 'pedro.sanchez@example.com'),
('Lucía López', 'lucia.lopez@example.com'),
('David Martínez', 'david.martinez@example.com'),
('Sara García', 'sara.garcia@example.com'),
('José Fernández', 'jose.fernandez@example.com'),
('Elena Ruiz', 'elena.ruiz@example.com');
