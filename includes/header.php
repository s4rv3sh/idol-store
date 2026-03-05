<?php
if (!defined('SITE_NAME')) {
    require_once __DIR__ . '/../config/config.php';
}
$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' : ''; ?><?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=Source+Sans+3:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <header class="site-header">
        <div class="header-inner">
            <a href="<?php echo SITE_URL; ?>index.php" class="logo">
                <span class="logo-icon">🕉</span>
                <span class="logo-text"><?php echo SITE_NAME; ?></span>
            </a>
            <nav class="main-nav">
                <a href="<?php echo SITE_URL; ?>index.php" class="<?php echo $current_page === 'index' ? 'active' : ''; ?>">Home</a>
                <a href="<?php echo SITE_URL; ?>products.php" class="<?php echo $current_page === 'products' ? 'active' : ''; ?>">Paintings</a>
                <a href="<?php echo SITE_URL; ?>cart.php" class="nav-cart <?php echo $current_page === 'cart' ? 'active' : ''; ?>">
                    Cart
                    <?php
                    $cart_count = 0;
                    if (!empty($_SESSION['cart'])) {
                        foreach ($_SESSION['cart'] as $qty) $cart_count += $qty;
                    }
                    if ($cart_count > 0):
                    ?>
                    <span class="cart-badge"><?php echo $cart_count; ?></span>
                    <?php endif; ?>
                </a>
            </nav>
        </div>
    </header>
    <main class="main-content">
