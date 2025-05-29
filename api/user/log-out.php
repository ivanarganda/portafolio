<?php 

header('Content-Type: application/json');

// Destruir todas las variables de sesión

session_start();

session_unset();

session_destroy();

// Devolver una respuesta de éxito

echo json_encode(['status' => 'success','message' => 'Sesión finalizada correctamente']);

exit;

?>