<?php
$envPath = '.env.ini';
$conexion = false;

try {
    // Habilitar excepciones en MySQLi
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $config = parse_ini_file($envPath);
    // Configurar conexión
    $host = $config['DB_HOST'];
    $database = $config['DB_NAME'];
    $username = $config['DB_USER'];
    $password = $config['DB_PASS'];

    // Crear instancia de MySQLi
    $conexion = new mysqli($host, $username, $password, $database);

} catch (Exception $e) {
    // Manejar errores de conexión
    error_log("Error de conexión: " . $e->getMessage());
    $conexion = false;
}
?>
