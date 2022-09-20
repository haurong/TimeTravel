<?php 
//require __DIR__ . '/parts/admin-required.php';
require __DIR__ . '/../../parts/connect_db.php'; 

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$sql = "DELETE FROM tickets WHERE sid={$sid}";

$pdo->query($sql);

$come_from = 'ticket.php';  //重回list

//$_SERVER['HTTP_REFERER'] 獲取前一頁面的URL 地址
if(! empty($_SERVER['HTTP_REFERER'])){
    $come_from = $_SERVER['HTTP_REFERER'];
}

header("Location: {$come_from}");
