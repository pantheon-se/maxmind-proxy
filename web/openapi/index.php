<?php

require '../../vendor/autoload.php';

// Transform JSON
$openapi = json_decode(file_get_contents(__DIR__ . '/openapi.json'), true);

// Get protocol
$protocol = 'http://';
if (isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
    $protocol = 'https://';
}

// Replace URL
$openapi['servers'][0]['url'] = $protocol . $_SERVER['HTTP_HOST'];
Flight::json($openapi);
Flight::start();