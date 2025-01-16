DROP DATABASE pentland;
create database pentland;
use pentland;

CREATE TABLE Roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL
);

CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    apellido varchar(50) DEFAULT NULL,
    correo varchar(255) DEFAULT NULL,
    passCorreo varchar(255) DEFAULT NULL,
    rol varchar(255) DEFAULT NULL
    
);

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombreP VARCHAR(100)  NULL,
    descripcion TEXT  NULL,
    precio DECIMAL(10, 2)  NULL,
    cantidad INT  NULL,
    categoria VARCHAR(200)  NULL,
    imagen VARCHAR(255)  NULL
);

-- Tabla para las ofertas (Opción 1: información básica)
CREATE TABLE ofertas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    producto_id INT,
    descuento DECIMAL(5,2),
    duracion INT,
    imagen VARCHAR(255),
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);

-- Tabla para el texto de las ofertas (Opción 1)
CREATE TABLE textos_ofertas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    oferta_id INT,
    titulo VARCHAR(255),
    subtitulo VARCHAR(255),
    descripcion TEXT,
    FOREIGN KEY (oferta_id) REFERENCES ofertas(id)
);

--  --  --  -- O --  --  --  --

-- Tabla para las ofertas (Opción 2: toda la información)
-- CREATE TABLE ofertas (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     producto_id INT,
--     descuento DECIMAL(5,2),
--     duracion INT,
--     imagen VARCHAR(255),
--     titulo VARCHAR(255),
--     subtitulo VARCHAR(255),
--     descripcion TEXT,
--     FOREIGN KEY (producto_id) REFERENCES productos(id)
-- );