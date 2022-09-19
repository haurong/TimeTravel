<?php 
//連結權限頁
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

// $sql = "UPDATE `address_book` SET 
// `name`=?,
// `email`=?,
// `mobile`=?,
// `birthday`=?,
// `address`=?
// WHERE sid=?";
$sql = "UPDATE `food_product_all` SET 
`product_number`=?,
`product_name`=?,
`p_selling_price`=?,
`p_discounted_price`=?,
`product_photo`=?,
`applicable_store`=?,
`product_introdution`=?,
`p_business_hours`=?,
`product_address`=?,
`listing_status_sid`=?,
`categories_sid`=?,
`city_sid`=?
WHERE sid=?";

$stmt = $pdo->prepare($sql);

$product_address = null;
if(strtotime($_POST['product_adress'])!==false){
    $product_adress = $_POST['product_adress'];
}


try {
    $stmt->execute([
        $_POST['product_number'],
        $_POST['product_name'],
        $_POST['p_selling_price'],
        $_POST['p_discounted_price'],
        $_POST['product_photo'],
        $_POST['applicable_store'],
        $_POST['product_introdution'],
        $_POST['p_business_hours'],
        $product_adress,
        $_POST['listing_status_sid'],
        $_POST['categories_sid'],
        $_POST['city_sid'],
        $_POST['sid']
    ]);
} catch(PDOException $ex) {
    $output['error'] = $ex->getMessage();
}


if($stmt->rowCount()){
    $output['success'] = true;
} else {
    if(empty($output['error']))
        $output['error'] = '資料沒有修改';
}
echo json_encode($output, JSON_UNESCAPED_UNICODE); 