<?php 
require_once dirname(dirname(__FILE__)) . '/models/User.php';

$response = [];

try {
    // Get POST data
    $data = json_decode(file_get_contents('php://input'), true);

    $username = $data['username'];
    $password = $data['password'];
    $gender = $data['gender'];
    $birthdate = $data['birth_date'];
    
    if (empty($username) || empty($password) || empty($gender) || empty($birthdate)){
        throw new Exception('Completa los datos del formulario');
    }

    $credentials = get_credentials($username);

    if (!empty($credentials)) {
        throw new Exception('Credenciales ya existentes');
    }
    
    // Register user
    $id = register_user( $username,$password,$birthdate,$gender);

    // Success response
    $response = [
        'status' => 'success',
        'message' => 'Usuario registrado correctamente',
        'last_id' => $id
    ];

} catch (Exception $e) {
    // Error response
    $response = [
        'status' => 'error',
        'error' => $e->getMessage()
    ];
}

?>