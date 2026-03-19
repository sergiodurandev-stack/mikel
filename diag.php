<?php
header('Content-Type: application/json');
echo json_encode([
    'php'       => PHP_VERSION,
    'writable'  => is_writable(__DIR__),
    'save_exists' => file_exists(__DIR__ . '/save.php'),
    'content_exists' => file_exists(__DIR__ . '/content.js'),
    'post_max'  => ini_get('post_max_size'),
    'upload_max'=> ini_get('upload_max_filesize'),
]);
