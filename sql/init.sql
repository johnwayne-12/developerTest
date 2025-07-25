
CREATE DATABASE IF NOT EXISTS cbc;
USE cbc;

DROP TABLE IF EXISTS clubes;
CREATE TABLE clubes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    clube VARCHAR(255) NOT NULL,
    saldo_disponivel DECIMAL(10,2) NOT NULL
);

DROP TABLE IF EXISTS recursos;
CREATE TABLE recursos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    recurso VARCHAR(255) NOT NULL,
    saldo_disponivel DECIMAL(10,2) NOT NULL
);

INSERT INTO recursos (recurso, saldo_disponivel) VALUES
('Recurso para passagens', 10000.00),
('Recurso para hospedagens', 10000.00);