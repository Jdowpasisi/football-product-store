<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
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
            
        case 'add_all_to_cart':
            foreach ($_SESSION['wishlist'] as $product_id) {
                if (isset($_SESSION['cart'][$product_id])) {
                    $_SESSION['cart'][$product_id]++;
                } else {
                    $_SESSION['cart'][$product_id] = 1;
                }
            }
            $_SESSION['wishlist'] = array();
            $response['success'] = true;
            break;
    }
    
    if (isset($_POST['ajax'])) {
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}
?>
