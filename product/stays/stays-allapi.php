<?php

require __DIR__ . '/../../parts/connect_athome_db.php';

header('Content-Type: application/json');

$sql = "SELECT * 
FROM `area`
WHERE 1";

$row = $pdo->query($sql)->fetchAll();

echo json_encode($row, JSON_UNESCAPED_UNICODE);

?>
