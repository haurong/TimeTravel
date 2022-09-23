<?php
// require __DIR__ . '/../parts/connect_athome_db.php';
require __DIR__ . '/../parts/connect_db.php';

header('Content-Type: application/json');

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
    'postData' => $_POST, // 除錯用的
];

if (empty($_POST['password'])) {
    $output['error'] = '參數不足';
    $output['code'] = 400;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// TODO: 檢查欄位資料

// $sql =
//     "SELECT `password_hash` FROM member_information WHERE `password_hash` = '$hash'";

$telephone = null;
$sql = "INSERT INTO `member_information`(
    `username`,
    `email`,
    `password_hash`,
    `telephone`
    ) VALUES (?, ?, ?, ?)";

$stmt = $pdo->prepare($sql);


try {
    $stmt->execute([
        $_POST['username'],
        $_POST['email'],
        password_hash($_POST['password_hash'], PASSWORD_DEFAULT),
        $_POST['telephone'],
    ]);
} catch (PDOException $ex) {
    $output['error'] = $ex->getMessage();
}


if ($stmt->rowCount()) {
    $output['success'] = true;
} else {
    if (empty($output['error']))
        $output['error'] = '資料沒有新增';
}




echo json_encode($output, JSON_UNESCAPED_UNICODE);
