<?php
require_once 'config.php';

// Handle cart actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $response = array();
        
        switch ($_POST['action']) {
            case 'add':
                $product_id = intval($_POST['product_id']);
                if (isset($_SESSION['cart'][$product_id])) {
                    $_SESSION['cart'][$product_id]++;
                } else {
                    $_SESSION['cart'][$product_id] = 1;
                }
                $response['success'] = true;
                $response['cart_count'] = count($_SESSION['cart']);
                break;
                
            case 'update':
                $product_id = intval($_POST['product_id']);
                $quantity = intval($_POST['quantity']);
                if ($quantity > 0) {
                    $_SESSION['cart'][$product_id] = $quantity;
                } else {
                    unset($_SESSION['cart'][$product_id]);
                }
                $response['success'] = true;
                break;
                
            case 'remove':
                $product_id = intval($_POST['product_id']);
                unset($_SESSION['cart'][$product_id]);
                $response['success'] = true;
                $response['cart_count'] = count($_SESSION['cart']);
                break;
        }
        
        if (isset($_POST['ajax'])) {
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    }
}

// Get cart items
$cart_items = array();
$total = 0;

if (!empty($_SESSION['cart'])) {
    $ids = array_keys($_SESSION['cart']);
    $ids_string = implode(',', $ids);
    $query = "SELECT * FROM products WHERE id IN ($ids_string)";
    $result = mysqli_query($conn, $query);
    
    while ($product = mysqli_fetch_assoc($result)) {
        $product['quantity'] = $_SESSION['cart'][$product['id']];
        $product['subtotal'] = $product['price'] * $product['quantity'];
        $total += $product['subtotal'];
        $cart_items[] = $product;
    }
}

$page_title = 'Shopping Cart - SportsFit';
$active_page = 'cart';

include 'includes/header.php';
?>

    <div class="page-header">
        <div class="container">
            <h1>Shopping Cart</h1>
            <p>Review your items and proceed to checkout</p>
        </div>
    </div>

    <section class="cart-section">
        <div class="container">
            <?php if (!empty($cart_items)): ?>
            <div class="cart-layout">
                <div class="cart-items">
                    <?php foreach ($cart_items as $item): ?>
                    <div class="cart-item" data-product-id="<?php echo $item['id']; ?>">
                        <div class="cart-item-image">
                            <img src="images/<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>" onerror="this.src='images/placeholder.jpg'">
                        </div>
                        <div class="cart-item-details">
                            <h3><?php echo $item['name']; ?></h3>
                            <p class="cart-item-category"><?php echo $item['category']; ?></p>
                            <p class="cart-item-price">₹<?php echo number_format($item['price'], 2); ?></p>
                        </div>
                        <div class="cart-item-quantity">
                            <label>Quantity:</label>
                            <div class="quantity-controls">
                                <button class="qty-btn" onclick="updateQuantity(<?php echo $item['id']; ?>, <?php echo $item['quantity'] - 1; ?>)">-</button>
                                <input type="number" class="qty-input" value="<?php echo $item['quantity']; ?>" min="1" max="<?php echo $item['stock']; ?>" onchange="updateQuantity(<?php echo $item['id']; ?>, this.value)">
                                <button class="qty-btn" onclick="updateQuantity(<?php echo $item['id']; ?>, <?php echo $item['quantity'] + 1; ?>)">+</button>
                            </div>
                        </div>
                        <div class="cart-item-subtotal">
                            <p class="subtotal-label">Subtotal:</p>
                            <p class="subtotal-amount">₹<?php echo number_format($item['subtotal'], 2); ?></p>
                        </div>
                        <div class="cart-item-remove">
                            <button class="btn-remove" onclick="removeFromCart(<?php echo $item['id']; ?>)">Remove</button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>


                <div class="cart-summary">
                    <h3>Order Summary</h3>
                    <div class="summary-row">
                        <span>Subtotal:</span>
                        <span>₹<?php echo number_format($total, 2); ?></span>
                    </div>
                    <div class="summary-row">
                        <span>Shipping:</span>
                        <span>₹<?php echo $total > 5000 ? '0.00' : '100.00'; ?></span>
                    </div>
                    <?php if ($total > 5000): ?>
                    <p class="free-shipping">🎉 You get FREE shipping!</p>
                    <?php else: ?>
                    <p class="shipping-info">Add ₹<?php echo number_format(5000 - $total, 2); ?> more for FREE shipping</p>
                    <?php endif; ?>
                    <hr>
                    <div class="summary-row total">
                        <span>Total:</span>
                        <span>₹<?php echo number_format($total + ($total > 5000 ? 0 : 100), 2); ?></span>
                    </div>
                    <button class="btn btn-primary btn-block" onclick="checkout()">Proceed to Checkout</button>
                    <a href="products.php" class="btn btn-secondary btn-block">Continue Shopping</a>
                </div>
            </div>
            <?php else: ?>
            <div class="empty-state">
                <h2>Your cart is empty</h2>
                <p>Add some products to your cart to see them here.</p>
                <a href="products.php" class="btn btn-primary">Start Shopping</a>
            </div>
            <?php endif; ?>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
