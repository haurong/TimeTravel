<?php 

require __DIR__ . '/../../parts/connect_db.php'; 

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$sql = "DELETE FROM food_product_all WHERE sid={$sid}";

$pdo->query($sql);

$come_from = 'food-list.php';

if(! empty($_SERVER['HTTP_REFERER'])){
    $come_from = $_SERVER['HTTP_REFERER'];
}
header("Location: {$come_from}");