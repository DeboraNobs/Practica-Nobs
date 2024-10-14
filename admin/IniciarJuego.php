<?php
    require '../config/Conexion.php';

    $conexionObj = new Conexion();
    $conn = $conexionObj->get_conexion();

    if ($conn) {
        try {
            $sqlDropUsuarios = 'DROP TABLE IF EXISTS usuarios';
            $conn->exec($sqlDropUsuarios);

            $sqlTableUsuarios = 'CREATE TABLE usuarios (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nickname VARCHAR(50) NOT NULL,
                email VARCHAR(100) NOT NULL,
                password VARCHAR(255) NOT NULL,
                imagen VARCHAR(255),
                fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )';
            $conn->exec($sqlTableUsuarios);

            // --------------

            $sqlDropConfiguracion = 'DROP TABLE IF EXISTS configuracion';
            $conn->exec($sqlDropConfiguracion);

            $sqlTableConfiguracion = 'CREATE TABLE configuracion (
                clave VARCHAR(255) NOT NULL,
                valor VARCHAR(255) NOT NULL
            )';
            $conn->exec($sqlTableConfiguracion);

            // -----------
            $sqlDropCartas = 'DROP TABLE IF EXISTS cartas';
            $conn->exec($sqlDropCartas);

            $sqlTableCartas = 'CREATE TABLE `cartas` (
                `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `nombre` varchar(100) NOT NULL,
                `ataque` int NOT NULL,
                `defensa` int NOT NULL,
                `tipo` varchar(150) NOT NULL,
                `nombreImagen` varchar(150) NOT NULL,
                `poderEspecial` varchar(150) NOT NULL
            )';

            echo "Tablas creadas exitosamente.";
        } catch (PDOException $e) {
            echo 'Error al crear las tablas: ' . $e->getMessage();
        }
    } else {
        echo 'No se pudo establecer la conexión a la base de datos.';
    }
?>