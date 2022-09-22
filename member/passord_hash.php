<?php
// require __DIR__ . '/../parts/connect_athome_db.php';
require __DIR__ . '/../parts/connect_db.php';

$hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO `member_information`(
    `password_hash`) VALUES (?)";

$stmt = $pdo->prepare($sql);
$stmt->execute([$hash]);
// $row = $stmt->fetch();
