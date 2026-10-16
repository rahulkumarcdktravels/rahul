<?php
require_once __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'Airlines Group Travel | Your Guide to Smarter Group Air Travel';
$metaDescription = 'Explore airline group travel information, group flight guidance, airline policies, and practical travel tips with Airlines Group Travel.';
$posts = get_posts(6);
include __DIR__ . '/includes/header.php';
?>
<section class="hero">
  <div class="hero-copy">
    <span class="eyebrow">TRAVEL TOGETHER. PLAN SMARTER.</span>
    <h1>Your Guide to Smarter <span>Group Air Travel</span></h1>
    <p>Helpful information for planning group flights, understanding airline requirements, and making your next group journey easier to organize.</p>
    <div class="hero-actions"><a class="btn btn-primary" href="<?= e(url('group-flights.php')) ?>">Explore Group Flights</a><a class="btn btn-outline" href="<?= e(url('blog.php')) ?>">Read Our Blog</a></div>
    <div class="hero-note"><span class="dot"></span> Practical travel information, all in one place</div>
  </div>
  <div class="hero-art" role="img" aria-label="Illustration of a plane flying above clouds">
    <div class="sun"></div><div class="cloud cloud-one"></div><div class="cloud cloud-two"></div>
    <div class="plane">✈</div><div class="route-line"></div>
    <div class="art-card"><span class="art-icon">✦</span><div><strong>Group travel made clearer</strong><small>Guides • Tips • Airline information</small></div></div>
  </div>
</section>
<section class="trust-strip"><div><strong>Group Flight Guides</strong><span>Understand the process</span></div><div><strong>Airline Information</strong><span>Know what to check</span></div><div><strong>Travel Tips</strong><span>Plan with confidence</span></div></section>
<section class="section intro-grid"><div><span class="eyebrow">WELCOME TO AIRLINES GROUP TRAVEL</span><h2>Make group travel easier to understand.</h2></div><div><p>Coordinating a group trip can involve different timelines, passenger details, and airline-specific rules. We bring useful travel information together so you can research your options and prepare with confidence.</p><a class="text-link" href="<?= e(url('about.php')) ?>">Learn about us <span>→</span></a></div></section>
<section class="section feature-section"><div class="section-heading"><div><span class="eyebrow">PLAN YOUR JOURNEY</span><h2>Explore group travel resources</h2></div><a class="text-link" href="<?= e(url('group-flights.php')) ?>">View group flight guide →</a></div>
<div class="feature-grid">
 <article class="feature-card feature-blue"><div class="feature-icon">✈</div><h3>Group Flights</h3><p>Learn about common group booking steps, passenger coordination, and questions to ask an airline.</p><a href="<?= e(url('group-flights.php')) ?>">Explore guide <span>↗</span></a></article>
 <article class="feature-card feature-white"><div class="feature-icon">▤</div><h3>Airline Policies</h3><p>Review airline-specific information and always confirm current terms directly with the airline.</p><a href="<?= e(url('blog.php')) ?>">Browse articles <span>↗</span></a></article>
 <article class="feature-card feature-white"><div class="feature-icon">◎</div><h3>Travel Planning Tips</h3><p>Find helpful ideas for organizing passenger details, deadlines, and travel documents.</p><a href="<?= e(url('blog.php')) ?>">Read travel tips <span>↗</span></a></article>
</div></section>
<section class="section blog-section"><div class="section-heading"><div><span class="eyebrow">THE LATEST</span><h2>Fresh from the blog</h2><p>Guides and ideas to help you plan your next group journey.</p></div><a class="text-link" href="<?= e(url('blog.php')) ?>">All blog posts →</a></div>
<div class="blog-grid">
<?php if ($posts): foreach ($posts as $post): ?>
<article class="blog-card">
  <a class="blog-image" href="<?= e(url('blog-details.php?slug=' . rawurlencode($post['slug']))) ?>"><?php if (!empty($post['image'])): ?><img src="<?= e(url($post['image'])) ?>" alt="<?= e($post['image_alt'] ?: $post['title']) ?>" loading="lazy"><?php else: ?><div class="image-placeholder"><span>✈</span><small>AIRLINES GROUP TRAVEL</small></div><?php endif; ?></a>
  <div class="blog-card-body"><span class="post-meta"><?= e(date('M j, Y', strtotime($post['published_at'] ?: $post['created_at']))) ?> · <?= e($post['category_name'] ?: 'Travel Tips') ?></span><h3><a href="<?= e(url('blog-details.php?slug=' . rawurlencode($post['slug']))) ?>"><?= e($post['title']) ?></a></h3><p><?= e($post['excerpt']) ?></p><a class="text-link" href="<?= e(url('blog-details.php?slug=' . rawurlencode($post['slug']))) ?>">Read article →</a></div>
</article>
<?php endforeach; else: ?>
<div class="empty-state"><div class="empty-icon">▤</div><h3>Your first travel story starts here</h3><p>Sign in to the admin panel to publish a blog post. Published posts will appear here automatically.</p><a class="btn btn-primary" href="<?= e(url('admin/login.php')) ?>">Admin login</a></div>
<?php endif; ?>
</div></section>
<section class="cta-section"><div><span class="eyebrow">READY TO START PLANNING?</span><h2>Bring your group travel plans into focus.</h2><p>Explore our resources or get in touch with a question.</p></div><a class="btn btn-light" href="<?= e(url('contact.php')) ?>">Contact Us <span>→</span></a></section>
<?php include __DIR__ . '/includes/footer.php'; ?>