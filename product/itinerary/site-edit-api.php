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


$sql = "UPDATE `site` SET 
`name`=?,
`area_sid`=?,
`site_category_sid`=?,
`description`=?,
`img_small`=?,
`website`=?
WHERE sid=?";

$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([
        $_POST['name'],
        $_POST['area_sid'],
        $_POST['site_category_sid'],
        $_POST['description'],
        $_POST['img_small'],
        $_POST['website'],
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