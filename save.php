<?php
// ============================================================
// SAVE.PHP — Guarda content.js en el servidor
// Misma contraseña que admin.html
// ============================================================

header('Content-Type: application/json');

// ─── CONTRASEÑA (debe coincidir con admin.html) ───────────────
define('ADMIN_PASSWORD', 'mikel2026');

// ─── ENDPOINT DE DIAGNÓSTICO: GET /save.php?diag ─────────────
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['diag'])) {
    $file = __DIR__ . '/content.js';
    $dir  = __DIR__;

    $phpUser  = function_exists('posix_geteuid')
        ? (posix_getpwuid(posix_geteuid())['name'] ?? posix_geteuid())
        : get_current_user();

    $fileOwner = file_exists($file) && function_exists('posix_getpwuid')
        ? (posix_getpwuid(fileowner($file))['name'] ?? fileowner($file))
        : (file_exists($file) ? fileowner($file) : 'no existe');

    $dirOwner = function_exists('posix_getpwuid')
        ? (posix_getpwuid(fileowner($dir))['name'] ?? fileowner($dir))
        : fileowner($dir);

    echo json_encode([
        'php_version'      => PHP_VERSION,
        'php_user'         => $phpUser,
        'server_software'  => $_SERVER['SERVER_SOFTWARE'] ?? '?',
        'dir'              => $dir,
        'dir_writable'     => is_writable($dir),
        'dir_owner'        => $dirOwner,
        'dir_perms'        => decoct(fileperms($dir) & 0777),
        'content_js'       => [
            'exists'   => file_exists($file),
            'writable' => file_exists($file) ? is_writable($file) : 'n/a',
            'owner'    => $fileOwner,
            'perms'    => file_exists($file) ? decoct(fileperms($file) & 0777) : 'n/a',
            'size_kb'  => file_exists($file) ? round(filesize($file) / 1024, 1) : 0,
        ],
        'open_basedir'     => ini_get('open_basedir') ?: 'no restriction',
        'post_max_size'    => ini_get('post_max_size'),
        'upload_max_size'  => ini_get('upload_max_filesize'),
        'memory_limit'     => ini_get('memory_limit'),
        'last_php_error'   => error_get_last(),
    ], JSON_PRETTY_PRINT);
    exit;
}

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
