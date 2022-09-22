<?php 
require __DIR__ . '/../parts/connect_athome_db.php'; 
// require __DIR__ . '/../parts/connect_db.php'; 
header('Content-Type: application/json');

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
];

$sql = "SELECT * FROM member_information WHERE email=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_POST['username']]);
$row = $stmt->fetch();

if ($_POST['email'] != $row['email']) {
    $output['success'] = true;
} else {
    $output['error'] = '此帳號已註冊'; 
    $output['code'] = 424;
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);

?>