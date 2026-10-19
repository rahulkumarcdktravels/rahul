<?php
declare(strict_types=1);
if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }
define('SITE_NAME', 'Airlines Group Travel');
define('BASE_URL', getenv('BASE_URL') ?: '');
$configFile = __DIR__ . '/../config/database.php';
if (file_exists($configFile)) { require_once $configFile; }
function e($value): string { return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
function url(string $path = ''): string { return rtrim(BASE_URL, '/') . '/' . ltrim($path, '/'); }
function db(): PDO {
    static $pdo = null;
    if ($pdo instanceof PDO) return $pdo;
    $cfg = require __DIR__ . '/../config/database.php';
    $dsn = "mysql:host={$cfg['host']};dbname={$cfg['name']};charset=utf8mb4";
    $pdo = new PDO($dsn, $cfg['user'], $cfg['pass'], [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES=>false]);
    return $pdo;
}
function get_posts(int $limit = 0, string $search = '', string $category = ''): array {
    try {
        $sql = "SELECT p.*, c.name AS category_name FROM posts p LEFT JOIN categories c ON c.id=p.category_id WHERE p.status='published'";
        $args = [];
        if ($search !== '') { $sql .= " AND (p.title LIKE ? OR p.excerpt LIKE ? OR p.content LIKE ?)"; $like='%'.$search.'%'; array_push($args,$like,$like,$like); }
        if ($category !== '') { $sql .= " AND c.slug=?"; $args[]=$category; }
        $sql .= " ORDER BY COALESCE(p.published_at,p.created_at) DESC";
        if ($limit > 0) $sql .= " LIMIT " . (int)$limit;
        $st=db()->prepare($sql); $st->execute($args); return $st->fetchAll();
    } catch (Throwable $ex) { return []; }
}
function get_page(string $slug): ?array {
    try { $st=db()->prepare("SELECT * FROM pages WHERE slug=? AND status='published' LIMIT 1"); $st->execute([$slug]); $r=$st->fetch(); return $r ?: null; } catch(Throwable $ex) { return null; }
}
function csrf_token(): string { if (empty($_SESSION['csrf'])) $_SESSION['csrf']=bin2hex(random_bytes(32)); return $_SESSION['csrf']; }
function csrf_check(): void { if ($_SERVER['REQUEST_METHOD']==='POST' && !hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) { http_response_code(403); exit('Invalid security token. Please go back and try again.'); } }
function admin_logged_in(): bool { return !empty($_SESSION['admin_id']); }
function require_admin(): void { if (!admin_logged_in()) { header('Location: '.url('admin/login.php')); exit; } }
function flash(string $message, string $type='success'): void { $_SESSION['flash']=['message'=>$message,'type'=>$type]; }
function show_flash(): void { if (!empty($_SESSION['flash'])) { $f=$_SESSION['flash']; echo '<div class="notice notice-'.e($f['type']).'">'.e($f['message']).'</div>'; unset($_SESSION['flash']); } }
function excerpt(string $text, int $length=150): string { $text=trim(strip_tags($text)); return mb_strlen($text)>$length ? mb_substr($text,0,$length-1).'…' : $text; }
