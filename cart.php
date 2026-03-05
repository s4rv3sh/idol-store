<?php
$page_title = 'Cart';
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/header.php';

// Remove single item via GET
if (isset($_GET['remove'])) {
    $pid = (int)$_GET['remove'];
    unset($_SESSION['cart'][$pid]);
    header('Location: cart.php');
    exit;
}
// Update quantities via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cart'])) {
    foreach ($_POST['qty'] ?? [] as $pid => $qty) {
        $pid = (int)$pid;
        $qty = (int)$qty;
        if ($qty <= 0) {
            unset($_SESSION['cart'][$pid]);
        } else {
            $_SESSION['cart'][$pid] = $qty;
        }
    }
    header('Location: cart.php');
    exit;
}

$cart = $_SESSION['cart'] ?? [];
$cart_products = [];
$total = 0;

if (!empty($cart)) {
    $pdo = getDB();
    $ids = array_keys($cart);
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $stmt = $pdo->prepare("SELECT id, name, price, image_path, stock FROM products WHERE id IN ($placeholders)");
    $stmt->execute(array_values($ids));
    while ($row = $stmt->fetch()) {
        $row['quantity'] = $cart[$row['id']];
        $row['subtotal'] = $row['price'] * $row['quantity'];
        $total += $row['subtotal'];
        $cart_products[] = $row;
    }
}
?>

<section class="section cart-section">
    <h1 class="page-title">Your Cart</h1>
    <?php if (empty($cart_products)): ?>
    <p class="empty-state">Your cart is empty. <a href="products.php">Browse paintings</a>.</p>
    <?php else: ?>
    <form method="post">
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart_products as $p): ?>
                <tr>
                    <td class="cart-product">
                        <img src="<?php echo htmlspecialchars($p['image_path']); ?>" alt="" onerror="this.src='images/placeholder.svg'">
                        <span><?php echo htmlspecialchars($p['name']); ?></span>
                    </td>
                    <td><?php echo CURRENCY . number_format($p['price'], 2); ?></td>
                    <td>
                        <input type="number" name="qty[<?php echo $p['id']; ?>]" value="<?php echo $p['quantity']; ?>" min="1" max="<?php echo (int)$p['stock']; ?>">
                    </td>
                    <td><?php echo CURRENCY . number_format($p['subtotal'], 2); ?></td>
                    <td>
                        <a href="cart.php?remove=<?php echo $p['id']; ?>" class="btn-remove" onclick="return confirm('Remove this item?');">Remove</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="cart-actions">
            <button type="submit" name="update_cart" class="btn btn-secondary">Update Cart</button>
            <div class="cart-total">
                <strong>Total: <?php echo CURRENCY . number_format($total, 2); ?></strong>
                <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
            </div>
        </div>
    </form>
    <?php endif; ?>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
