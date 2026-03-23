<?php
// ============================================================
// UPLOAD.PHP — Sube archivos individuales a /uploads/
// Misma contraseña que admin.html
// ============================================================

error_reporting(0);
ini_set('display_errors', '0');
ob_start();

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

define('ADMIN_PASSWORD', 'mikel2026');

$token = $_POST['token'] ?? '';
if ($token !== ADMIN_PASSWORD) {
    ob_end_clean();
    http_response_code(403);
    echo json_encode(['ok' => false, 'error' => 'No autorizado']);
    exit;
}

if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    $code = $_FILES['file']['error'] ?? UPLOAD_ERR_NO_FILE;
    ob_end_clean();
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Error al recibir archivo (código ' . $code . ')']);
    exit;
}

$file = $_FILES['file'];

$allowedTypes = [
    'image/jpeg', 'image/png', 'image/gif',
    'image/svg+xml', 'image/webp', 'image/avif',
    'video/mp4', 'video/webm', 'video/ogg'
];

$origExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

// SVG detection via extension (finfo puede reportarlo incorrectamente)
if ($origExt === 'svg') {
    $mimeType = 'image/svg+xml';
} else {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
}

if (!in_array($mimeType, $allowedTypes)) {
    ob_end_clean();
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Tipo de archivo no permitido: ' . $mimeType]);
    exit;
}

$uploadDir = __DIR__ . '/uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$filename = uniqid('u', true) . '.' . $origExt;
$dest = $uploadDir . $filename;

if (!move_uploaded_file($file['tmp_name'], $dest)) {
    ob_end_clean();
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'No se pudo guardar el archivo. Verifica permisos.']);
    exit;
}

ob_end_clean();
echo json_encode(['ok' => true, 'path' => 'uploads/' . $filename]);
