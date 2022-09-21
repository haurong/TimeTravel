<?php

require __DIR__ . '/../../parts/connect_db.php';

header('Content-Type: application/json');

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
    'postData' => $_POST
];



$sql = "INSERT INTO `jietest`(
    `pic`
    ) VALUES (?)";

$stmt = $pdo->prepare($sql);


try {
    $stmt->execute([
        $_POST['pic']
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
