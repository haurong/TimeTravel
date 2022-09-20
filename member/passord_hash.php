<?php require __DIR__ . '/../parts/connect_db.php'; ?>
<?php

$hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO `member_information`(
    `password`) VALUES (?)";

$stmt = $pdo->prepare($sql);

?>