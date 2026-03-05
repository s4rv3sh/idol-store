<?php
require_once __DIR__ . '/config/config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header('Location: products.php');
    exit;
}

$pdo = getDB();
$stmt = $pdo->prepare('SELECT p.*, c.name AS category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.id = ?');
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    header('Location: products.php');
    exit;
}

$page_title = $product['name'];

// Add to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $qty = isset($_POST['quantity']) ? max(1, (int)$_POST['quantity']) : 1;
    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + $qty;
    header('Location: cart.php');
    exit;
}

require_once __DIR__ . '/includes/header.php';
?>

<section class="section product-detail">
    <div class="product-detail-grid">
        <div class="product-detail-image">
            <img src="<?php echo htmlspecialchars($product['image_path']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" onerror="this.src='images/placeholder.svg'">
        </div>
        <div class="product-detail-info">
            <span class="product-category"><?php echo htmlspecialchars($product['category_name'] ?? 'Painting'); ?></span>
            <h1><?php echo htmlspecialchars($product['name']); ?></h1>
            <p class="product-detail-price"><?php echo CURRENCY . number_format($product['price'], 2); ?></p>
            <div class="product-detail-desc"><?php echo nl2br(htmlspecialchars($product['description'] ?? '')); ?></div>
            <p class="product-stock"><?php echo (int)$product['stock'] > 0 ? 'In stock' : 'Out of stock'; ?></p>
            <?php if ((int)$product['stock'] > 0): ?>
            <form method="post" class="add-to-cart-form">
                <label for="qty">Quantity:</label>
                <input type="number" id="qty" name="quantity" value="1" min="1" max="<?php echo (int)$product['stock']; ?>">
                <button type="submit" name="add_to_cart" class="btn btn-primary">Add to Cart</button>
            </form>
            <?php endif; ?>
            <a href="products.php" class="btn btn-secondary back-link">← Back to Paintings</a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
