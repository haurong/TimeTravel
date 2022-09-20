<?php

require __DIR__ . '/../../parts/connect_db.php';

header('Content-Type: application/json');

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
    'postData' => $_POST,
];

if (empty($_POST['hotel_name'])) {
    $output['error'] = '參數不足';
    $output['code'] = 400;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}


$sql = "INSERT INTO `hotel`(
    `categories_sid`, `	area_sid`, `hotel_name`, `hotel_code`, `phone`, `address`
    , `wifi` , `breakfast` , `lunch` , `dinner` , `check_in` , `check_out` , `facility` , `tag` , `	create_time`
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

$stmt = $connection->prepare($sql);

if ($stmt->rowCount()) {
    $output['success'] = true;
} else {
    if (empty($output['error']))
        $output['error'] = '新增失敗';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
