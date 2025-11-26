<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'KickZone - Football Store'; ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand">
                <a href="index.php">KickZone</a>
            </div>
            <ul class="nav-menu">
                <li><a href="index.php" class="<?php echo $active_page == 'home' ? 'active' : ''; ?>">Home</a></li>
                <li class="dropdown">
                    <a href="products.php" class="dropdown-toggle <?php echo $active_page == 'products' ? 'active' : ''; ?>">Products</a>
                    <div class="dropdown-menu">
                        <a href="products.php?category=Football">Footballs</a>
                        <a href="products.php?category=Accessories">Accessories</a>
                        <a href="products.php?category=Shoes">Football Shoes</a>
                    </div>
                </li>
                <li><a href="wishlist.php" class="<?php echo $active_page == 'wishlist' ? 'active' : ''; ?>">Wishlist <span class="badge" id="wishlist-count"><?php echo count($_SESSION['wishlist']); ?></span></a></li>
                <li><a href="cart.php" class="<?php echo $active_page == 'cart' ? 'active' : ''; ?>">Cart <span class="badge" id="cart-count"><?php echo count($_SESSION['cart']); ?></span></a></li>
                <li><a href="help.php" class="<?php echo $active_page == 'help' ? 'active' : ''; ?>">Help</a></li>
                <?php if (isLoggedIn()): ?>
                <li class="user-actions">
                    <span class="user-welcome">Hi, <?php echo htmlspecialchars(getUsername()); ?>!</span>
                    <a href="logout.php" class="btn btn-small btn-secondary">Logout</a>
                </li>
                <?php else: ?>
                <li><a href="login.php" class="btn btn-small btn-primary">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
