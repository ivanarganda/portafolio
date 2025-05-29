<?php 
require_once dirname(dirname(__FILE__)) . '/config/conection.php';
require_once dirname(dirname(__FILE__)) . '/controllers/HelpersController.php';

function get_credentials($username) {
    global $conexion;
    
    $sql = "SELECT * FROM usuarios WHERE nombre = ? AND state = 1";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_object();

}

function register_user($username, $password, $birthdate, $gender) {
    global $conexion;

    // Generar un ID único de 6 caracteres
    $idusuario = get_random_id_user();
    $today = new DateTime(); 
    $birthdateObj = new DateTime($birthdate);
    $age = $today->diff($birthdateObj)->y; 
    
    // Hashear la contraseña
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Consulta SQL corregida
    $sql = "INSERT INTO usuarios (id_usuario, nombre, password, edad, sexo) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('sssss', $idusuario, $username, $password, $age, $gender);

    if ($stmt->execute()) {
        return $conexion->insert_id; // Devuelve el último ID insertado
    } else {
        return false; // Retorna false si la inserción falla
    }
}

?>