<?php
//連結權限頁
//require __DIR__ . '/../../parts/connect_athome_db.php'; 
require __DIR__ . './../parts/connect_db.php';

// if(empty($_POST['123'])){
//     $output['error'] = '參數不足';
//     $output['code'] = 400;
//     echo json_encode($output, JSON_UNESCAPED_UNICODE); 
//     exit;
// }
//

$o_sql = "INSERT INTO `orders`(`member_sid`, `orders_created_time`) VALUES (?,  NOW())";
$o_stmt = $pdo->prepare($o_sql);
$o_stmt->execute([
    $_SESSION['admin']['sid']
]);
// TODO: 檢查欄位資料

$orders_sid = $pdo->lastInsertId(); // 最近新增資料的 PK

if (!empty($_SESSION['food-cart'])) {
    $odf_sql = "INSERT INTO `orders_details_food`(`orders_sid`, `food_products_sid`, `quantity`, `total_price`) VALUES (?, ?, ?, ?)";
    $odf_stmt = $pdo->prepare($odf_sql);
    $odf_stmt->execute([
        $orders_sid,
        $_POST['food_sid'],
        $_POST['food_quantity'],
        $_POST['food_total_price']
    ]);
    
}

if (!empty($_SESSION['hotel-cart'])) {
    $odh_sql = "INSERT INTO `orders_details_hotel`(`orders_sid`, `hotel_products_sid`) VALUES (?,?)";
    $odh_stmt = $pdo->prepare($odh_sql);
    $odh_stmt->execute([
        $orders_sid,
        $_POST['hotel_sid']
    ]);
    
}

if (!empty($_SESSION['ticket-cart'])) {
    $odt_sql = "INSERT INTO `orders_details_ticket`(`orders_sid`, `ticket_products_sid`,`quantity`,`total_price`) VALUES (?,?,?,?)";
    $odt_stmt = $pdo->prepare($odt_sql);
    $odt_stmt->execute([
        $orders_sid,
        $_POST['ticket_sid'],
        $_POST['ticket_quantity'],
        $_POST['ticket_total_price']
    ]);
    
}
unset($_SESSION['food-cart']);
unset($_SESSION['hotel-cart']);
unset($_SESSION['ticket-cart']);
?>
<?php include __DIR__ . '/../parts/html-head.php'; ?>
<?php include __DIR__ . '/../parts/navbar.php'; ?>

<div class="container">
    <div class="alert alert-success" role="alert">
        感謝訂購 
    </div>

</div>
<?php include __DIR__ . '/../parts/script.php'; ?>

<?php include __DIR__ . '/../parts/html-foot.php'; ?>
