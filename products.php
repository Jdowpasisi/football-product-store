<?php
require_once 'config.php';

// Get category filter
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Build query
$query = "SELECT * FROM products WHERE 1=1";

if (!empty($category)) {
    $query .= " AND category = '" . mysqli_real_escape_string($conn, $category) . "'";
}

$query .= " ORDER BY name ASC";
$result = mysqli_query($conn, $query);

$page_title = 'Products - KickZone';
$active_page = 'products';

// Include header
include 'includes/header.php';
?>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1>Our Products</h1>
            <p>Premium Football Equipment & Gear</p>
        </div>
    </div>

    <!-- Products Section -->
    <section class="products-section">
        <div class="container">
            <!-- Category Filter -->
            <div class="category-filter">
                <a href="products.php" class="btn <?php echo empty($category) ? 'btn-primary' : 'btn-secondary'; ?>">All Products</a>
                <a href="products.php?category=Football" class="btn <?php echo $category == 'Football' ? 'btn-primary' : 'btn-secondary'; ?>">Footballs</a>
                <a href="products.php?category=Accessories" class="btn <?php echo $category == 'Accessories' ? 'btn-primary' : 'btn-secondary'; ?>">Accessories</a>
                <a href="products.php?category=Shoes" class="btn <?php echo $category == 'Shoes' ? 'btn-primary' : 'btn-secondary'; ?>">Football Shoes</a>
            </div>

            <!-- Products Grid -->
            <?php if (mysqli_num_rows($result) > 0): ?>
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
                        <p class="product-description"><?php echo htmlspecialchars($product['description']); ?></p>
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
            <?php else: ?>
            <div class="empty-state">
                <h2>No products found</h2>
                <p>Try selecting a different category.</p>
                <a href="products.php" class="btn btn-primary">View All Products</a>
            </div>
            <?php endif; ?>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1>Our Products</h1>
            <p>Browse our complete collection of sports equipment and gear</p>
        </div>
    </div>

    <!-- Products Section -->
    <section class="products-section">
        <div class="container">
            <div class="products-layout">
                <!-- Sidebar Filters -->
                <aside class="filters-sidebar">
                    <h3>Filters</h3>
                    
                    <!-- Search -->
                    <div class="filter-group">
                        <label>Search Products</label>
                        <form method="GET" action="products.php">
                            <input type="text" name="search" class="search-input" placeholder="Search..." value="<?php echo htmlspecialchars($search); ?>">
                            <?php if (!empty($category)): ?>
                            <input type="hidden" name="category" value="<?php echo htmlspecialchars($category); ?>">
                            <?php endif; ?>
                            <button type="submit" class="btn btn-small">Search</button>
                        </form>
                    </div>

                    <!-- Categories -->
                    <div class="filter-group">
                        <label>Category</label>
                        <ul class="category-list">
                            <li><a href="products.php" class="<?php echo empty($category) ? 'active' : ''; ?>">All Products</a></li>
                            <?php while($cat = mysqli_fetch_assoc($categories_result)): ?>
                            <li><a href="products.php?category=<?php echo $cat['category']; ?>" class="<?php echo $category == $cat['category'] ? 'active' : ''; ?>"><?php echo $cat['category']; ?></a></li>
                            <?php endwhile; ?>
                        </ul>
                    </div>

                    <?php if (!empty($category) || !empty($search)): ?>
                    <a href="products.php" class="btn btn-secondary">Clear Filters</a>
                    <?php endif; ?>
                </aside>

                <!-- Products Grid -->
                <div class="products-main">
                    <?php if (mysqli_num_rows($result) > 0): ?>
                    <div class="products-grid">
                        <?php while($product = mysqli_fetch_assoc($result)): ?>
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" onerror="this.src='images/placeholder.jpg'">
                                <?php if ($product['stock'] < 10 && $product['stock'] > 0): ?>
                                <span class="stock-badge low-stock">Only <?php echo $product['stock']; ?> left</span>
                                <?php elseif ($product['stock'] == 0): ?>
                                <span class="stock-badge out-of-stock">Out of Stock</span>
                                <?php endif; ?>
                            </div>
                            <div class="product-info">
                                <h3><?php echo $product['name']; ?></h3>
                                <p class="product-category"><?php echo $product['category']; ?></p>
                                <p class="product-description"><?php echo substr($product['description'], 0, 100); ?>...</p>
                                <div class="product-footer">
                                    <span class="price">₹<?php echo number_format($product['price'], 2); ?></span>
                                    <div class="product-actions">
                                        <button class="btn-icon" onclick="addToWishlist(<?php echo $product['id']; ?>)" title="Add to Wishlist">❤</button>
                                        <?php if ($product['stock'] > 0): ?>
                                        <button class="btn btn-small" onclick="addToCart(<?php echo $product['id']; ?>)">Add to Cart</button>
                                        <?php else: ?>
                                        <button class="btn btn-small" disabled>Out of Stock</button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                    <?php else: ?>
                    <div class="empty-state">
                        <h2>No products found</h2>
                        <p>Try adjusting your filters or search terms.</p>
                        <a href="products.php" class="btn btn-primary">View All Products</a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
