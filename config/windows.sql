-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 10-04-2025 a las 14:14:32
-- Versión del servidor: 8.2.0
-- Versión de PHP: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `portafolio_windows`
--
CREATE DATABASE IF NOT EXISTS `portafolio_windows` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `portafolio_windows`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

-- 1. Usuarios
-- Tabla de Dispositivos
CREATE TABLE dispositivos (
    id_dispositivo INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    mac_address VARCHAR(50),
    uuid VARCHAR(100),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de Usuarios
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    id_dispositivo INT,
    nombre_usuario VARCHAR(50),
    password VARCHAR(255),
    email VARCHAR(100),
    wallpaper VARCHAR(255),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_dispositivo) REFERENCES dispositivos(id_dispositivo)
);

-- Tabla de Aplicaciones
CREATE TABLE aplicaciones (
    id_aplicacion INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    version VARCHAR(50),
    descripcion TEXT,
    ruta_ejecucion VARCHAR(255),
    icono VARCHAR(255)
);

-- Tabla de Carpetas
CREATE TABLE carpetas (
    id_carpeta INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    id_aplicacion INT DEFAULT NULL,
    nombre VARCHAR(100),
    ruta VARCHAR(255),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_aplicacion) REFERENCES aplicaciones(id_aplicacion)
);

-- Tabla de Archivos
CREATE TABLE archivos (
    id_archivo INT AUTO_INCREMENT PRIMARY KEY,
    id_carpeta INT,
    nombre VARCHAR(100),
    tipo VARCHAR(20),
    contenido TEXT,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_carpeta) REFERENCES carpetas(id_carpeta)
);

-- Tabla de Accesos Directos
CREATE TABLE accesos_directos (
    id_acceso_directo INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    id_aplicacion INT DEFAULT NULL,
    id_archivo INT DEFAULT NULL,
    nombre VARCHAR(100),
    ruta VARCHAR(255),
    icono VARCHAR(255),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_aplicacion) REFERENCES aplicaciones(id_aplicacion),
    FOREIGN KEY (id_archivo) REFERENCES archivos(id_archivo)
);

-- Tabla de Configuración de Escritorio
CREATE TABLE configuracion_escritorio (
    id_configuracion INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    posicion_iconos JSON,
    tema VARCHAR(50),
    modo VARCHAR(20),
    barra_tareas_visible BOOLEAN,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

-- Tabla de Comandos de Terminal CMD
CREATE TABLE comandos_terminal (
    id_comando INT AUTO_INCREMENT PRIMARY KEY,
    nombre_comando VARCHAR(50),
    descripcion TEXT,
    ejemplo TEXT
);

-- Insertar comandos básicos en la terminal
INSERT INTO comandos_terminal (nombre_comando, descripcion, ejemplo) VALUES
('dir', 'Lista archivos y carpetas en el directorio actual', 'dir'),
('cd', 'Cambia el directorio actual', 'cd carpeta'),
('cls', 'Limpia la pantalla', 'cls'),
('copy', 'Copia archivos de un lugar a otro', 'copy origen destino'),
('del', 'Elimina uno o más archivos', 'del archivo.txt'),
('mkdir', 'Crea una nueva carpeta', 'mkdir nueva_carpeta'),
('rmdir', 'Elimina una carpeta vacía', 'rmdir carpeta'),
('echo', 'Muestra un mensaje en pantalla', 'echo Hola Mundo'),
('exit', 'Cierra la terminal', 'exit');