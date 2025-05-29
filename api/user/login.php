<?php

session_start();

header('Access-Control-Allow-Methods: POST');

require_once dirname(dirname(dirname(__FILE__))) . '/controllers/LoginController.php';

echo json_encode($response); 