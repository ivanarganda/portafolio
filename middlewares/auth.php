<?php  
// session_start();

// $currentPage = $_SERVER['PHP_SELF']; // Obtiene solo el nombre del archivo en ejecución

// // Definimos rutas principales
// $loginPage = 'login.php';
// $dashboardPage = 'dashboard.php';
// $mainPage = 'main.php';

// $redirect = '';

// if (!isset($_SESSION['credentials']) && strpos($currentPage,$mainPage) !== false){
//     $redirect = 'resources/views/'.$loginPage; 
// }

// if (isset($_SESSION['credentials']) && strpos($currentPage,$mainPage) !== false){
//     $redirect = 'resources/views/'.$dashboardPage; 
// }

// if (!isset($_SESSION['credentials']) && ( strpos($currentPage,$loginPage) === false && strpos($currentPage,$mainPage) === false)){
//     $redirect = $currentPage; 
// }

// if (!isset($_SESSION['credentials']) && strpos($currentPage,$loginPage) === false && strpos($currentPage,$mainPage) === false){
//     $redirect = $loginPage;
// }


// if (isset($_SESSION['credentials']) && strpos($currentPage,$loginPage) !== false){
//     $redirect = $dashboardPage; 
// }

// header('Location: '.$redirect);
?>
