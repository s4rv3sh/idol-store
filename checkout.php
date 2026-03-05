<?php
$page_title = 'Checkout';
require_once __DIR__ . '/config/config.php';

$cart = $_SESSION['cart'] ?? [];
if (empty($cart)) {
    header('Location: cart.php');
    exit;
}

$pdo = getDB();
$ids = array_keys($cart);
$placeholders = implode(',', array_fill(0, count($ids), '?'));
$stmt = $pdo->prepare("SELECT id, name, price, stock FROM products WHERE id IN ($placeholders)");
$stmt->execute(array_values($ids));
$items = [];
$total = 0;
while ($row = $stmt->fetch()) {
    $qty = $cart[$row['id']];
    if ($qty > (int)$row['stock']) $qty = (int)$row['stock'];
    $row['quantity'] = $qty;
    $row['subtotal'] = $row['price'] * $qty;
    $total += $row['subtotal'];
    $items[] = $row;
}

$success = false;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    if (strlen($name) < 2) $errors[] = 'Please enter your name.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Please enter a valid email.';
    if (strlen($phone) < 5) $errors[] = 'Please enter your phone number.';
    if (strlen($address) < 10) $errors[] = 'Please enter your full delivery address.';
    if (empty($errors)) {
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare('INSERT INTO orders (customer_name, email, phone, address, total, status) VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->execute([$name, $email, $phone, $address, $total, 'pending']);
            $order_id = $pdo->lastInsertId();
            $istmt = $pdo->prepare('INSERT INTO order_items (order_id, product_id, product_name, quantity, price) VALUES (?, ?, ?, ?, ?)');
            foreach ($items as $item) {
                $istmt->execute([$order_id, $item['id'], $item['name'], $item['quantity'], $item['price']]);
            }
            $pdo->commit();
            $_SESSION['cart'] = [];
            $success = true;
        } catch (Exception $e) {
            $pdo->rollBack();
            $errors[] = 'Order could not be placed. Please try again.';
        }
    }
}

if ($success) {
    require_once __DIR__ . '/includes/header.php';
    ?>
    <section class="section checkout-success">
        <h1>Thank You!</h1>
        <p>Your order has been placed successfully. We will contact you at <?php echo htmlspecialchars($email); ?> for delivery details.</p>
        <a href="products.php" class="btn btn-primary">Continue Shopping</a>
    </section>
    <?php
    require_once __DIR__ . '/includes/footer.php';
    exit;
}

require_once __DIR__ . '/includes/header.php';
?>

<section class="section checkout-section">
    <h1 class="page-title">Checkout</h1>
    <?php if (!empty($errors)): ?>
    <ul class="error-list">
        <?php foreach ($errors as $e): ?>
        <li><?php echo htmlspecialchars($e); ?></li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    <div class="checkout-grid">
        <div class="checkout-form-wrap">
            <form method="post" class="checkout-form">
                <label for="name">Full Name *</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" required>
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                <label for="phone">Phone *</label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>" required>
                <label for="address">Delivery Address *</label>
                <textarea id="address" name="address" rows="4" required><?php echo htmlspecialchars($_POST['address'] ?? ''); ?></textarea>
                <button type="submit" class="btn btn-primary btn-block">Place Order</button>
            </form>
        </div>
        <div class="order-summary">
            <h2>Order Summary</h2>
            <ul>
                <?php foreach ($items as $item): ?>
                <li><?php echo htmlspecialchars($item['name']); ?> × <?php echo $item['quantity']; ?> — <?php echo CURRENCY . number_format($item['subtotal'], 2); ?></li>
                <?php endforeach; ?>
            </ul>
            <p class="order-total"><strong>Total: <?php echo CURRENCY . number_format($total, 2); ?></strong></p>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
