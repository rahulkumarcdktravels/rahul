<?php
require_once __DIR__.'/includes/bootstrap.php';header('Content-Type: application/xml; charset=utf-8');
$base=(isset($_SERVER['HTTPS'])&&$_SERVER['HTTPS']!=='off'?'https':'http').'://'.($_SERVER['HTTP_HOST']??'localhost');
echo '<?xml version="1.0" encoding="UTF-8"?>'."\n";echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
$urls=['/index.php','/blog.php','/group-flights.php','/contact.php','/about.php','/services.php','/privacy-policy.php','/terms.php','/disclaimer.php'];
foreach($urls as $u)echo '<url><loc>'.htmlspecialchars($base.url($u),ENT_XML1,'UTF-8').'</loc></url>';
try{foreach(db()->query("SELECT slug,updated_at FROM posts WHERE status='published'") as $p)echo '<url><loc>'.htmlspecialchars($base.url('blog-details.php?slug='.rawurlencode($p['slug'])),ENT_XML1,'UTF-8').'</loc><lastmod>'.date('c',strtotime($p['updated_at'])).'</lastmod></url>';}catch(Throwable $e){}
try{foreach(db()->query("SELECT slug,updated_at FROM pages WHERE status='published' AND is_system=0") as $p)echo '<url><loc>'.htmlspecialchars($base.url('page.php?slug='.rawurlencode($p['slug'])),ENT_XML1,'UTF-8').'</loc><lastmod>'.date('c',strtotime($p['updated_at'])).'</lastmod></url>';}catch(Throwable $e){}
echo '</urlset>';
