<?php
require __DIR__ . '/../parts/connect_db.php';
$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
unset($_SESSION['hotel-cart'][$sid]);
$come_from = 'cart-list.php';

if(! empty($_SERVER['HTTP_REFERER'])){
    $come_from = $_SERVER['HTTP_REFERER'];
}
header("Location: {$come_from}");
?>