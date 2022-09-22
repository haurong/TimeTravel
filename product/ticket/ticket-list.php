<?php require __DIR__ . '/../../parts/connect_db.php'; 

$perPage = 30; //一頁幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; //第幾頁,有被設定就選那頁,沒有就第1頁

//算資料總比數
$t_sql = "SELECT COUNT(1) FROM tickets ";

//query資料庫溝通
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

$totalPages = ceil($totalRows / $perPage);
//ceil 天花板 floor 地板,


$rows = []; //預設給他一個陣列
//如果有資料,做判別
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
        "SELECT * FROM tickets 
    JOIN `area` 
    ON `tickets`.`cities_id` = `area`.`area_sid`
    JOIN `city`
    ON `area`.`city_sid` = `city`.`city_sid`
    JOIN `tickets_categories`
    ON `tickets`.`categories_id` = `tickets_categories`.`id`
    JOIN `listing_status`
    ON `tickets`.`on_sale` = `listing_status`.`status_sid`
    ORDER BY sid DESC LIMIT %s, %s",
        ($page - 1) * $perPage,
        $perPage
    );
    //第1個參數%s, 索引值 ;第2個參數%s抓幾個   DESC降冪 ASC升冪

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


<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=1">
                            最前一頁
                        </a>
                    </li>
                    <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page - 1 ?>">
                            <i class="fa-solid fa-circle-arrow-left"></i>
                        </a>
                    </li>

                    <?php for ($i = $page - 4; $i <= $page + 4; $i++) :
                        if ($i >= 1 and $i <= $totalPages) :
                    ?>
                            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                    <?php
                        endif;
                    endfor; ?>

                    <li class="page-item <?= $totalPages == $page ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page + 1 ?>">
                            <i class="fa-solid fa-circle-arrow-right"></i>
                        </a>
                    </li>
                    <li class="page-item <?= $totalPages == $page ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $totalPages ?>">
                            最後一頁
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <?php

    if (empty($_SESSION['admin'])) {
        include __DIR__ . '/list-table-no-admin.php';
    } else {
        include __DIR__ . '/list-table-admin.php';
    }
    ?>


    <?php include __DIR__ . '/../../parts/script.php'; ?>
    <script>
        const table = document.querySelector('table');

        function delete_it(sid) {
            if (confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)) {
                location.href = `ticket-delete.php?sid=${sid}`;
            }
        }
    </script>

    <?php include __DIR__ . '/../../parts/html-foot.php'; ?>