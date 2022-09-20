<?php 
$pageName = 'list';

$perPage = 5; // 一頁有幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// 算總筆數
$t_sql = "SELECT COUNT(1) FROM `site` ";
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
        "SELECT * FROM `site` 
        JOIN `area` ON `site`.`area_sid`=`area`.`area_sid` 
        JOIN `city` ON `area`.`city_sid`=`city`.`city_sid`
        JOIN `site_categories` ON `site`.`site_category_sid`=`site_categories`.`site_category_sid`
        ORDER BY `site`.`sid` DESC
        LIMIT %s, %s",
        ($page - 1) * $perPage, $perPage
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

?>