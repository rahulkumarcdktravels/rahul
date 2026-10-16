<?php
require_once __DIR__.'/includes/bootstrap.php';
$pageTitle='Blog | Airlines Group Travel'; $metaDescription='Read group flight guides, airline information, and practical travel planning tips.';
$q=trim($_GET['q'] ?? ''); $category=trim($_GET['category'] ?? ''); $page=max(1,(int)($_GET['page'] ?? 1)); $perPage=9;
$all=get_posts(0,$q,$category); $total=count($all); $posts=array_slice($all,($page-1)*$perPage,$perPage);
try {$categories=db()->query("SELECT c.name,c.slug,COUNT(p.id) AS post_count FROM categories c LEFT JOIN posts p ON p.category_id=c.id AND p.status='published' GROUP BY c.id ORDER BY c.name")->fetchAll();} catch(Throwable $e){$categories=[];}
include __DIR__.'/includes/header.php';
?>
<section class="page-hero"><div class="container"><span class="eyebrow">TRAVEL KNOWLEDGE, SHARED</span><h1>The Airlines Group Travel Blog</h1><p>Explore helpful articles on group flights, airline policies, and the details that can make travel planning smoother.</p></div></section>
<section class="section"><div class="container">
<form class="search-form" method="get"><input type="search" name="q" value="<?=e($q)?>" placeholder="Search articles and travel guides..." aria-label="Search blog posts"><button class="btn btn-primary" type="submit">Search articles</button></form>
<?php if($categories): ?><div class="admin-toolbar"><a class="btn btn-outline" href="<?=e(url('blog.php'))?>">All articles</a><?php foreach($categories as $cat): ?><a class="btn btn-outline" href="<?=e(url('blog.php?category='.rawurlencode($cat['slug'])))?>"><?=e($cat['name'])?> (<?= (int)$cat['post_count']?>)</a><?php endforeach;?></div><?php endif;?>
<div class="blog-grid">
<?php foreach($posts as $post): ?><article class="blog-card"><a class="blog-image" href="<?=e(url('blog-details.php?slug='.rawurlencode($post['slug'])))?>"><?php if($post['image']):?><img src="<?=e(url($post['image']))?>" alt="<?=e($post['image_alt']?:$post['title'])?>" loading="lazy"><?php else:?><div class="image-placeholder"><span>✈</span><small>TRAVEL GUIDE</small></div><?php endif;?></a><div class="blog-card-body"><span class="post-meta"><?=e(date('M j, Y',strtotime($post['published_at']?:$post['created_at'])))?> · <?=e($post['category_name']?:'Travel Tips')?></span><h3><a href="<?=e(url('blog-details.php?slug='.rawurlencode($post['slug'])))?>"><?=e($post['title'])?></a></h3><p><?=e($post['excerpt'])?></p><a class="text-link" href="<?=e(url('blog-details.php?slug='.rawurlencode($post['slug'])))?>">Read article →</a></div></article><?php endforeach;?>
<?php if(!$posts):?><div class="empty-state"><h3>No articles found</h3><p>Try another search, or check back soon for more group travel resources.</p><a class="btn btn-primary" href="<?=e(url('blog.php'))?>">View all articles</a></div><?php endif;?>
</div>
<?php if($total>$perPage):?><div class="pagination"><?php for($i=1;$i<=ceil($total/$perPage);$i++):?><a class="<?=$i===$page?'current':''?>" href="<?=e(url('blog.php?'.http_build_query(['q'=>$q,'category'=>$category,'page'=>$i])))?>"><?=$i?></a><?php endfor;?></div><?php endif;?>
</div></section>
<?php include __DIR__.'/includes/footer.php';?>