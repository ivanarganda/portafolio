<?php 
require_once dirname(dirname(__FILE__)) . '/config/conection.php';

function get_credentials($username) {
    global $conexion;

    try {
        $sql = "SELECT * FROM usuarios WHERE nombre = ?";
        if (!$stmt = $conexion->prepare($sql)) {
            throw new Exception("Error preparando la consulta: " . $conexion->error);
        }

        if (!$stmt->bind_param('s', $username)) {
            throw new Exception("Error enlazando parámetros: " . $stmt->error);
        }

        if (!$stmt->execute()) {
            throw new Exception("Error ejecutando consulta: " . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return false; // Usuario no encontrado
        }

        return $result->fetch_object();

    } catch (Exception $e) {
        error_log('Error en get_credentials: ' . $e->getMessage());
        return false;
    }
}


?>