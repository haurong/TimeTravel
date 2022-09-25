<?php
// require __DIR__ . '/../../parts/connect_athome_db.php'; 
require __DIR__ . '/../../parts/connect_db.php';

$perPage = 10; // 一頁有幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// 算總筆數
$t_sql = "SELECT COUNT(1) FROM food_product_all ";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

$totalPages = ceil($totalRows / $perPage);

$rows = [];
// 如果有資料
if ($totalRows) {
    if ($page < 1) {
        header('Location: ?page=1');
        exit;
    }
    if ($page > $totalPages) {
        header('Location: ?page=' . $totalPages);
        exit;
    }

    $sql = sprintf(
        "SELECT * FROM `food_product_all`
         LEFT JOIN `city` ON `food_product_all`.`city_sid` = `city`.`city_sid` 
         LEFT JOIN `food_categories` ON `food_product_all`.`categories_sid` = `food_categories`.`categories_sid`
         ORDER BY `food_product_all`.`status_sid` LIMIT %s, %s",
        ($page - 1) * $perPage,
        $perPage
    );
    $rows = $pdo->query($sql)->fetchAll();
}

$output = [
    'totalRows' => $totalRows,
    'totalPages' => $totalPages,
    'page' => $page,
    'rows' => $rows,
    'perPage' => $perPage,
];

header('Content-Type: application/json');
echo json_encode($output); 