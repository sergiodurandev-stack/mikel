<?php
// ============================================================
// SAVE.PHP — Guarda content.js en el servidor
// Misma contraseña que admin.html
// ============================================================

// Suprimir warnings/notices que romperían el JSON
error_reporting(0);
ini_set('display_errors', '0');
ob_start(); // capturar cualquier output accidental

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// ─── CONTRASEÑA (debe coincidir con admin.html) ───────────────
define('ADMIN_PASSWORD', 'mikel2026');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    ob_end_clean();
    echo json_encode(['ok' => false, 'error' => 'Method not allowed']);
    exit;
}

// ─── MODO UPLOAD DE ARCHIVO ───────────────────────────────────────────
if (isset($_FILES['file'])) {
    if ($token !== ADMIN_PASSWORD) {
        ob_end_clean();
        http_response_code(403);
        echo json_encode(['ok' => false, 'error' => 'No autorizado']);
        exit;
    }
    $f = $_FILES['file'];
    if ($f['error'] !== UPLOAD_ERR_OK) {
        ob_end_clean();
        http_response_code(400);
        echo json_encode(['ok' => false, 'error' => 'Error al recibir archivo: ' . $f['error']]);
        exit;
    }
    $origExt = strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
    if ($origExt === 'svg') {
        $mime = 'image/svg+xml';
    } else {
        $fi = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($fi, $f['tmp_name']);
        finfo_close($fi);
    }
    $allowed = ['image/jpeg','image/png','image/gif','image/svg+xml','image/webp','image/avif','video/mp4','video/webm','video/ogg'];
    if (!in_array($mime, $allowed)) {
        ob_end_clean();
        http_response_code(400);
        echo json_encode(['ok' => false, 'error' => 'Tipo no permitido: ' . $mime]);
        exit;
    }
    $uploadDir = __DIR__ . '/uploads/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
    $filename = uniqid('u', true) . '.' . $origExt;
    if (!move_uploaded_file($f['tmp_name'], $uploadDir . $filename)) {
        ob_end_clean();
        http_response_code(500);
        echo json_encode(['ok' => false, 'error' => 'No se pudo guardar el archivo']);
        exit;
    }
    ob_end_clean();
    echo json_encode(['ok' => true, 'path' => 'uploads/' . $filename]);
    exit;
}

$token    = $_POST['token']   ?? '';
$content  = $_POST['content'] ?? '';

// ─── MODO DEPLOY: escribe cualquier archivo del sitio ─────────────────
if (isset($_POST['deploy_file'])) {
    if ($token !== ADMIN_PASSWORD) {
        ob_end_clean();
        http_response_code(403);
        echo json_encode(['ok' => false, 'error' => 'No autorizado']);
        exit;
    }
    $rel  = $_POST['deploy_file'] ?? '';
    $data = $_POST['deploy_content'] ?? '';
    // Seguridad: solo permitir rutas relativas sin ..
    if (empty($rel) || strpos($rel, '..') !== false || $rel[0] === '/') {
        ob_end_clean();
        http_response_code(400);
        echo json_encode(['ok' => false, 'error' => 'Ruta inválida']);
        exit;
    }
    $target = __DIR__ . '/' . $rel;
    $dir    = dirname($target);
    if (!is_dir($dir)) mkdir($dir, 0755, true);
    $result = file_put_contents($target, $data);
    ob_end_clean();
    if ($result === false) {
        http_response_code(500);
        echo json_encode(['ok' => false, 'error' => 'No se pudo escribir ' . $rel]);
    } else {
        echo json_encode(['ok' => true, 'file' => $rel, 'bytes' => $result]);
    }
    exit;
}

// Verificar contraseña
if ($token !== ADMIN_PASSWORD) {
    http_response_code(403);
    ob_end_clean();
    echo json_encode(['ok' => false, 'error' => 'No autorizado']);
    exit;
}

// Verificar que el contenido no esté vacío y sea JS válido
if (empty($content)) {
    http_response_code(400);
    ob_end_clean();
    echo json_encode(['ok' => false, 'error' => 'Contenido vacío']);
    exit;
}

if (strpos($content, 'const CONTENT') === false) {
    http_response_code(400);
    ob_end_clean();
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
    ob_end_clean();
    echo json_encode(['ok' => false, 'error' => 'No se pudo escribir el archivo. Verifica permisos.']);
    exit;
}

ob_end_clean();
echo json_encode(['ok' => true, 'bytes' => $result]);
