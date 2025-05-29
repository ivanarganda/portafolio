<?php 
require_once dirname(dirname(__FILE__)) . '/models/Login.php';

$response = [];

try {
    // Get POST data
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (empty($data['username']) || empty($data['password'])) {
        throw new Exception('Email and password are required');
    }

    $username = $data['username'];
    $password = $data['password'];

    $credentials = get_credentials($username);

    if ($credentials === false) {
        throw new Exception('Error al obtener las credenciales');
    }

    if (empty($credentials)) {
        throw new Exception('Credenciales invalidos');
    }
    
    if (!password_verify($password, $credentials->password)) {
        throw new Exception('Credenciales invalidos');
    }
    
    // Login successful
    $_SESSION['credentials'] = [
        'id' => $credentials->id_usuario,
        'username' => $credentials->nombre
    ];

    // Success response
    $response = [
        'status' => 'success'
    ];

} catch (Exception $e) {
    // Error response
    $response = [
        'status' => 'error',
        'error' => $e->getMessage()
    ];
}

?>