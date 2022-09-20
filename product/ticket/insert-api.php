<?php 
// require __DIR__ . '/parts/admin-required.php';
require __DIR__ . '/../../parts/connect_db.php';

header('Content-Type: application/json');

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
    'postData' => $_POST, // 除錯用的
];

if(empty($_POST['name'])){
    $output['error'] = '參數不足';
    $output['code'] = 400;
    echo json_encode($output, JSON_UNESCAPED_UNICODE); 
    exit;
}

// TODO: 檢查欄位資料

$sql = "INSERT INTO `tickets`(
    `product_number`, `product_name`, `product_price`, `product_introduction`, `product_notice`, `start_day`, `end_day`, `product_cover`, `product_imgs`, `categories_id`, `cities_id`, `on_sale`, 
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ";

$stmt = $pdo->prepare($sql);


try {
    $stmt->execute([
        $_POST['product_number'],
        $_POST['product_name'],
        $_POST['product_price'],
        $_POST['product_introduction'],
        $_POST['product_notice'],
        $_POST['start_day'],
        $_POST['end_day'],
        $_POST['roduct_cover'],
        $_POST['product_imgs'],
        $_POST['categories_id'],
        $_POST['cities_id'],
        $_POST['on_sale'],
    ]);
} catch(PDOException $ex) {
    $output['error'] = $ex->getMessage();
}


if($stmt->rowCount()){
    $output['success'] = true;
} else {
    if(empty($output['error']))
        $output['error'] = '資料沒有新增';

}




echo json_encode($output, JSON_UNESCAPED_UNICODE); 