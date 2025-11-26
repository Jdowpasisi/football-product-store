<?php
require_once 'config.php';

$type = isset($_GET['type']) ? $_GET['type'] : 'cart';

$count = 0;
if ($type === 'cart') {
    $count = count($_SESSION['cart']);
} elseif ($type === 'wishlist') {
    $count = count($_SESSION['wishlist']);
}

header('Content-Type: application/json');
echo json_encode(['count' => $count]);
?>
