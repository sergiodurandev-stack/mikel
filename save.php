<?php
// ============================================================
// SAVE.PHP — Guarda content.js en el servidor
// Misma contraseña que admin.html
// ============================================================

header('Content-Type: application/json');

// ─── CONTRASEÑA (debe coincidir con admin.html) ───────────────
define('ADMIN_PASSWORD', 'mikel2026');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Method not allowed']);
    exit;
}

$token    = $_POST['token']   ?? '';
$content  = $_POST['content'] ?? '';

// Verificar contraseña
if ($token !== ADMIN_PASSWORD) {
    http_response_code(403);
    echo json_encode(['ok' => false, 'error' => 'No autorizado']);
    exit;
}

// Verificar que el contenido no esté vacío y sea JS válido
if (empty($content)) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Contenido vacío']);
    exit;
}

if (strpos($content, 'const CONTENT') === false) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Contenido inválido']);
    exit;
}

// Ruta del archivo a sobreescribir
$file = __DIR__ . '/content.js';

// Diagnóstico de permisos antes de escribir
if (!file_exists($file)) {
    // El archivo no existe: verificar que el directorio sea escribible
    if (!is_writable(__DIR__)) {
        http_response_code(500);
        echo json_encode([
            'ok'    => false,
            'error' => 'Directorio no escribible',
            'dir'   => __DIR__,
            'owner' => function_exists('posix_getpwuid') ? posix_getpwuid(fileowner(__DIR__))['name'] ?? '?' : '(posix no disponible)',
            'php_user' => function_exists('posix_getpwuid') ? posix_getpwuid(posix_geteuid())['name'] ?? '?' : get_current_user(),
        ]);
        exit;
    }
} else {
    if (!is_writable($file)) {
        http_response_code(500);
        echo json_encode([
            'ok'       => false,
            'error'    => 'Archivo content.js no es escribible. Ajusta permisos a 644 con tu usuario FTP/Plesk.',
            'file'     => $file,
            'php_user' => function_exists('posix_getpwuid') ? posix_getpwuid(posix_geteuid())['name'] ?? '?' : get_current_user(),
        ]);
        exit;
    }
}

// Hacer backup del archivo anterior
$backup = __DIR__ . '/content.backup.js';
if (file_exists($file)) {
    copy($file, $backup);
}

// Escribir el nuevo content.js
$result = file_put_contents($file, $content, LOCK_EX);

if ($result === false) {
    $last = error_get_last();
    http_response_code(500);
    echo json_encode([
        'ok'    => false,
        'error' => 'file_put_contents falló',
        'php_error' => $last['message'] ?? 'desconocido',
        'file'  => $file,
    ]);
    exit;
}

echo json_encode(['ok' => true, 'bytes' => $result]);
