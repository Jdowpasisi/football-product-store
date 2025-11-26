<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $response = array();
        
        switch ($_POST['action']) {
            case 'add':
                $product_id = intval($_POST['product_id']);
                if (!in_array($product_id, $_SESSION['wishlist'])) {
                    $_SESSION['wishlist'][] = $product_id;
                }
                $response['success'] = true;
                $response['wishlist_count'] = count($_SESSION['wishlist']);
                break;
                
            case 'remove':
                $product_id = intval($_POST['product_id']);
                $key = array_search($product_id, $_SESSION['wishlist']);
                if ($key !== false) {
                    unset($_SESSION['wishlist'][$key]);
                    $_SESSION['wishlist'] = array_values($_SESSION['wishlist']);
                }
                $response['success'] = true;
                $response['wishlist_count'] = count($_SESSION['wishlist']);
                break;
        }
        
        if (isset($_POST['ajax'])) {
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    }
}

$wishlist_items = array();

if (!empty($_SESSION['wishlist'])) {
    $ids = implode(',', $_SESSION['wishlist']);
    $query = "SELECT * FROM products WHERE id IN ($ids)";
    $result = mysqli_query($conn, $query);
    
    while ($product = mysqli_fetch_assoc($result)) {
        $wishlist_items[] = $product;
    }
}

$page_title = 'Wishlist - SportsFit';
$active_page = 'wishlist';

include 'includes/header.php';
?>

    <div class="page-header">
        <div class="container">
            <h1>My Wishlist</h1>
            <p>Save your favorite products for later</p>
        </div>
    </div>

    <section class="wishlist-section">
        <div class="container">
            <?php if (!empty($wishlist_items)): ?>
            <div class="products-grid">
                <?php foreach ($wishlist_items as $product): ?>
                <div class="product-card" data-product-id="<?php echo $product['id']; ?>">
                    <button class="wishlist-remove-btn" onclick="removeFromWishlist(<?php echo $product['id']; ?>)" title="Remove from Wishlist">×</button>
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
                                <?php if ($product['stock'] > 0): ?>
                                <button class="btn btn-small" onclick="addToCart(<?php echo $product['id']; ?>)">Add to Cart</button>
                                <?php else: ?>
                                <button class="btn btn-small" disabled>Out of Stock</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="wishlist-actions">
                <button class="btn btn-primary" onclick="addAllToCart()">Add All to Cart</button>
                <a href="products.php" class="btn btn-secondary">Continue Shopping</a>
            </div>
            <?php else: ?>
            <div class="empty-state">
                <h2>Your wishlist is empty</h2>
                <p>Add products you love to your wishlist and save them for later.</p>
                <a href="products.php" class="btn btn-primary">Browse Products</a>
            </div>
            <?php endif; ?>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
