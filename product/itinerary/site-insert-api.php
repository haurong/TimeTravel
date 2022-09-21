<?php

require __DIR__ . '/../../parts/connect_db.php';

header('Content-Type: application/json');

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
    'postData' => $_POST
];

if (empty($_POST['name'])) {
    $output['error'] = '參數不足';
    $output['code'] = 400;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "INSERT INTO `site`(
    `name`, `area_sid`, `site_category_sid`, 
    `description`, `img_small`, `website`, 
    `map`, `created_date`) 
    VALUES (
     ?, ?, ?,
     ?, ?, ?,
     ?, NOW())";

$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([
        $_POST['name'],
        $_POST['area_sid'],
        $_POST['site_category_sid'],
        $_POST['description'],
        $_POST['img_small'],
        $_POST['website'],
        $_POST['map'],      
    ]);
} catch (PDOException $ex) {
    $output['error'] = $ex->getMessage();
}


if ($stmt->rowCount()) {
    $output['success'] = true;
} else {
    if (empty($output['error']))
        $output['error'] = '新增失敗';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
