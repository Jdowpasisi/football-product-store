<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
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
?>
