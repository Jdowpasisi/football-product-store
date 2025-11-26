<?php
require_once 'config.php';

// Fetch featured products (all products for display)
$query = "SELECT * FROM products ORDER BY RAND() LIMIT 6";
$result = mysqli_query($conn, $query);

$page_title = 'KickZone - Premium Football Store';
$active_page = 'home';

// Include header
include 'includes/header.php';
?>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Welcome to KickZone</h1>
            <p>Your Ultimate Destination for Football Gear</p>
            <a href="products.php" class="btn btn-primary">Shop Now</a>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="products-section">
        <div class="container">
            <h2 class="section-title">Featured Products</h2>
            <div class="products-grid">
                <?php while($product = mysqli_fetch_assoc($result)): ?>
                <div class="product-card">
                    <div class="product-image">
                        <?php 
                        $image_src = (strpos($product['image'], 'http') === 0) 
                            ? $product['image'] 
                            : 'images/' . $product['image'];
                        ?>
                        <img src="<?php echo $image_src; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" onerror="this.src='images/placeholder.jpg'">
                        <?php if ($product['stock'] < 10 && $product['stock'] > 0): ?>
                        <span class="stock-badge">Only <?php echo $product['stock']; ?> left</span>
                        <?php elseif ($product['stock'] == 0): ?>
                        <span class="stock-badge out-of-stock">Out of Stock</span>
                        <?php endif; ?>
                    </div>
                    <div class="product-info">
                        <p class="product-category"><?php echo $product['category']; ?></p>
                        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                        <p class="product-description"><?php echo htmlspecialchars(substr($product['description'], 0, 80)); ?>...</p>
                        <div class="product-footer">
                            <span class="price">₹<?php echo number_format($product['price'], 2); ?></span>
                            <div class="product-actions">
                                <button class="btn-icon" onclick="addToWishlist(<?php echo $product['id']; ?>)" title="Add to Wishlist">♥</button>
                                <?php if ($product['stock'] > 0): ?>
                                <button class="btn btn-small btn-primary" onclick="addToCart(<?php echo $product['id']; ?>)">Add to Cart</button>
                                <?php else: ?>
                                <button class="btn btn-small btn-primary" disabled>Out of Stock</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            <div class="text-center mt-2">
                <a href="products.php" class="btn btn-secondary">View All Products</a>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="category-filter">
        <div class="container">
            <h2 class="section-title">Shop by Category</h2>
            <a href="products.php?category=Football" class="btn btn-primary">Footballs</a>
            <a href="products.php?category=Accessories" class="btn btn-primary">Accessories</a>
            <a href="products.php?category=Shoes" class="btn btn-primary">Football Shoes</a>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
