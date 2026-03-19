<?php
// ============================================================
// SAVE.PHP — Guarda content.js en el servidor
// Misma contraseña que admin.html
// ============================================================

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: same-origin');

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

// Determinar qué archivo guardar según el idioma
$lang = $_POST['lang'] ?? '';
if ($lang === 'es') {
    $file   = __DIR__ . '/es/content.js';
    $backup = __DIR__ . '/es/content.backup.js';
} else {
    $file   = __DIR__ . '/content.js';
    $backup = __DIR__ . '/content.backup.js';
}
if (file_exists($file)) {
    copy($file, $backup);
}

// Escribir el nuevo content.js
$result = file_put_contents($file, $content);

if ($result === false) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'No se pudo escribir el archivo. Verifica permisos.']);
    exit;
}

echo json_encode(['ok' => true, 'bytes' => $result]);
