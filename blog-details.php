<?php
require_once __DIR__.'/includes/bootstrap.php';
$slug=trim($_GET['slug'] ?? '');
try {$st=db()->prepare("SELECT p.*,c.name AS category_name FROM posts p LEFT JOIN categories c ON c.id=p.category_id WHERE p.slug=? AND p.status='published' LIMIT 1");$st->execute([$slug]);$post=$st->fetch();}catch(Throwable $e){$post=null;}
if(!$post){http_response_code(404);$pageTitle='Article not found | Airlines Group Travel';include __DIR__.'/includes/header.php';echo '<section class="content-layout"><div class="container content-panel"><h1>Article not found</h1><p>This article may have moved or is no longer available.</p><a class="btn btn-primary" href="'.e(url('blog.php')).'">Back to blog</a></div></section>';include __DIR__.'/includes/footer.php';exit;}
$pageTitle=($post['meta_title']?:$post['title']).' | Airlines Group Travel';$metaDescription=$post['meta_description']?:$post['excerpt'];
include __DIR__.'/includes/header.php';
?>
<section class="page-hero"><div class="container"><span class="eyebrow"><?=e($post['category_name']?:'TRAVEL GUIDE')?> · <?=e(date('M j, Y',strtotime($post['published_at']?:$post['created_at'])))?></span><h1><?=e($post['title'])?></h1><p><?=e($post['excerpt'])?></p></div></section>
<section class="content-layout"><div class="container"><article class="content-panel"><div class="prose"><?php if($post['image']):?><img style="width:100%;max-height:430px;object-fit:cover;margin-bottom:28px" src="<?=e(url($post['image']))?>" alt="<?=e($post['image_alt']?:$post['title'])?>"><?php endif;?><?= $post['content'] ?></div><hr style="border:0;border-top:1px solid #e2edf4;margin:38px 0"><p class="post-meta">Written by <?=e($post['author']?:'Airlines Group Travel')?> · Last updated <?=e(date('M j, Y',strtotime($post['updated_at']?:$post['created_at'])))?></p><a class="btn btn-outline" href="<?=e(url('blog.php'))?>">← Back to blog</a></article></div></section>
<?php include __DIR__.'/includes/footer.php';?>