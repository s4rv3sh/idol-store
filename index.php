<?php
$page_title = 'Home';
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/header.php';

$pdo = getDB();
$stmt = $pdo->query('SELECT p.*, c.name AS category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.created_at DESC LIMIT 8');
$products = $stmt->fetchAll();
?>

<section class="hero">
    <div class="hero-content">
        <h1>Indian Idol Paintings</h1>
        <p class="hero-sub">Handcrafted devotional art for your home and temple. Lord Ganesha, Krishna, Lakshmi, Shiva & more.</p>
        <a href="products.php" class="btn btn-primary">Shop Paintings</a>
    </div>
</section>

<section class="section">
    <h2 class="section-title">Featured Paintings</h2>
    <div class="product-grid">
        <?php foreach ($products as $p): ?>
        <article class="product-card">
            <a href="product.php?id=<?php echo (int)$p['id']; ?>" class="product-image-wrap">
                <img src="<?php echo htmlspecialchars($p['image_path']); ?>" alt="<?php echo htmlspecialchars($p['name']); ?>" onerror="this.src='images/placeholder.svg'">
            </a>
            <div class="product-info">
                <span class="product-category"><?php echo htmlspecialchars($p['category_name'] ?? 'Painting'); ?></span>
                <h3><a href="product.php?id=<?php echo (int)$p['id']; ?>"><?php echo htmlspecialchars($p['name']); ?></a></h3>
                <p class="product-price"><?php echo CURRENCY . number_format($p['price'], 2); ?></p>
                <a href="product.php?id=<?php echo (int)$p['id']; ?>" class="btn btn-small">View</a>
            </div>
        </article>
        <?php endforeach; ?>
    </div>
    <?php if (count($products) >= 8): ?>
    <p class="section-cta"><a href="products.php" class="btn btn-secondary">View All Paintings</a></p>
    <?php endif; ?>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
