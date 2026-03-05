<?php
$page_title = 'Paintings';
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/header.php';

$pdo = getDB();
$category_filter = isset($_GET['category']) ? (int)$_GET['category'] : 0;

$sql = 'SELECT p.*, c.name AS category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE 1=1';
$params = [];
if ($category_filter > 0) {
    $sql .= ' AND p.category_id = ?';
    $params[] = $category_filter;
}
$sql .= ' ORDER BY p.name';
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();

$cats = $pdo->query('SELECT id, name FROM categories ORDER BY name')->fetchAll();
?>

<section class="section">
    <h1 class="page-title">Indian Idol Paintings</h1>
    <div class="filter-bar">
        <a href="products.php" class="filter-btn <?php echo $category_filter === 0 ? 'active' : ''; ?>">All</a>
        <?php foreach ($cats as $c): ?>
        <a href="products.php?category=<?php echo (int)$c['id']; ?>" class="filter-btn <?php echo $category_filter === (int)$c['id'] ? 'active' : ''; ?>"><?php echo htmlspecialchars($c['name']); ?></a>
        <?php endforeach; ?>
    </div>
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
    <?php if (empty($products)): ?>
    <p class="empty-state">No paintings found in this category.</p>
    <?php endif; ?>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
