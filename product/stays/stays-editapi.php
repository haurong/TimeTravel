<?php

require __DIR__ . '/../../parts/connect_db.php';

header('Content-Type: application/json');

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
    'postData' => $_POST
];

if (empty($_POST['hotel_name'])) {
    $output['error'] = '參數不足';
    $output['code'] = 400;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "UPDATE `hotel` SET 
`categories_sid`=?,
`area_sid`=?,
`hotel_name`=?,
`hotel_code`=?,
`phone`=?,
`address`=?,
`wifi`=?,
`breakfast`=?,
`lunch`=?,
`dinner`=?,
`check_in`=?,
`check_out`=?,
`facility`=?,
`tag`=?
WHERE sid=?";

$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([
        $_POST['categories_sid'],
        $_POST['area_sid'],
        $_POST['hotel_name'],
        $_POST['hotel_code'],
        $_POST['phone'],
        $_POST['address'],
        $_POST['wifi'],
        $_POST['breakfast'],
        $_POST['lunch'],
        $_POST['dinner'],
        $_POST['check_in'],
        $_POST['check_out'],
        $_POST['facility'],
        $_POST['tag'],
        $_POST['sid']
    ]);
} catch (PDOException $ex) {
    $output['error'] = $ex->getMessage();
}

if ($stmt->rowCount()) {
    $output['success'] = true;
} else {
    // if (empty($output['error']))
    //   $output['error'] = '資料沒有更改';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
