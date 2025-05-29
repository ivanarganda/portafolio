<?php

header('Access-Control-Allow-Methods: POST');

require_once dirname(dirname(dirname(__FILE__))) . '/controllers/UserController.php';

echo json_encode($response); 