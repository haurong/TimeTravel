<?php 
$pageName = 'list';

$perPage = 5; // 一頁有幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// 分類篩選
// $area = isset($_GET['area']) ? intval($_GET['area']) : 0;
$cate = isset($_GET['cate']) ? intval($_GET['cate']) : 0;
$pageBtnQS=[];

$where = ' WHERE 1 ';
// if(! empty($area)){
//     $where .= "AND area_sid=$area";
//     $pageBtnQS['area'] = $area;
// }
if(! empty($cate)){
    $where .= " AND `site`.`site_category_sid` = $cate";
    $pageBtnQS['cate'] = $cate;
}
// 分類篩選

// 算總筆數  +$where
$t_sql = "SELECT COUNT(1) FROM `site` $where";  
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

$totalPages = ceil($totalRows / $perPage);
// if($page<1) $page=1;
// if($page>$totalPages) $page=$totalPages;

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
        $where
        ORDER BY `site`.`sid`
        LIMIT %s, %s",
        ($page - 1) * $perPage, $perPage
    );
    $rows = $pdo->query($sql)->fetchAll();
}

//分類資料
// $a_sql = sprintf("SELECT * FROM `area`") ;
// $areas = $pdo->query($a_sql)->fetchAll();
$c_sql = "SELECT * FROM site_categories " ;
$cates = $pdo->query($c_sql)->fetchAll();
//分類資料

$output = [
    'totalRows' => $totalRows,
    'totalPages' => $totalPages,
    'page' => $page,
    'rows' => $rows,
    'perPage' => $perPage,
];

?>