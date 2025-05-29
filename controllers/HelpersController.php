<?php 

function loadEnv($path) {
    if (!file_exists($path)) return;

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue; // ignorar comentarios
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);
        putenv("$name=$value");
        $_ENV[$name] = $value;
        $_SERVER[$name] = $value;
    }
}

function write_log( $content ){
    $logFile = '../../config/logs/errors.txt';
    $logMessage = $content;
    file_put_contents($logFile, var_export($logMessage,true), FILE_APPEND);
}

function get_server(){
    $server = json_decode(json_encode($_SERVER));

    return [
        'ip_client' => $server->REMOTE_ADDR ?? null,
        'ip_client_full' => $server->HTTP_CLIENT_IP ?? $server->REMOTE_ADDR ?? null,
        'user_agent' =>  $server->HTTP_USER_AGENT ?? 'Unknown',
        'forwarded' => $server->HTTP_X_FORWARDED_FOR ?? null,
        'method' => $server->REQUEST_METHOD ?? null,
        'uri' => $server->REQUEST_URI ?? null,
        'host' => $server->HTTP_HOST ?? null,
        'referer' => $server->HTTP_REFERER ?? null,
        'accept' => $server->HTTP_ACCEPT ?? null,
        'accept_language' => $server->HTTP_ACCEPT_LANGUAGE ?? null,
        'accept_encoding' => $server->HTTP_ACCEPT_ENCODING ?? null,
        'connection' => $server->HTTP_CONNECTION ?? null,
        'cookie' => $server->HTTP_COOKIE ?? null,
        'cache_control' => $server->HTTP_CACHE_CONTROL ?? null,
        'upgrade_insecure_requests' => $server->HTTP_UPGRADE_INSECURE_REQUESTS ?? null,
        'sec_fetch_site' => $server->HTTP_SEC_FETCH_SITE ?? null,
        'sec_fetch_mode' => $server->HTTP_SEC_FETCH_MODE ?? null,
        'sec_fetch_user' => $server->HTTP_SEC_FETCH_USER ?? null,
        'sec_fetch_dest' => $server->HTTP_SEC_FETCH_DEST ?? null,
        'sec_ch_ua' => $server->HTTP_SEC_CH_UA ?? null,
        'sec_ch_ua_mobile' => $server->HTTP_SEC_CH_UA_MOBILE ?? null,
        'sec_ch_ua_platform' => $server->HTTP_SEC_CH_UA_PLATFORM ?? null,
        'sec_ch_ua_platform_version' => $server->HTTP_SEC_CH_UA_PLATFORM_VERSION ?? null,
        'sec_ch_ua_full_version_list' => $server->HTTP_SEC_CH_UA_FULL_VERSION_LIST ?? null,
        'sec_ch_ua_arch' => $server->HTTP_SEC_CH_UA_ARCH ?? null,
        'sec_ch_ua_model' => $server->HTTP_SEC_CH_UA_MODEL ?? null,
    ];
}

function get_total_rows( $table ){
    global $conexion;

    // Check if there's a logged-in user
    if (!isset($_SESSION['credentials'])) {
        return [
            'error' => true,
            'message' => 'No retrieving matches rows.'
        ];
    }

    $id_usuario = $_SESSION['credentials']['id'];

    // Example query: adapt as necessary
    $sql = "SELECT COUNT(*) as total_rows
            FROM $table";

    $stm = $conexion->prepare($sql);
    $stm->execute();
    $result = $stm->get_result();

    return $result->fetch_object()->total_rows;
}

function get_random_id_user(){
    return substr(md5(uniqid(rand())), 0, 7);
}
