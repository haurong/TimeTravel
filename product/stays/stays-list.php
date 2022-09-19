<?php require __DIR__ . '/../../parts/connect_db.php';

$perPage = 20;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$t_sql = "SELECT COUNT(1) FROM hotel";

$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

$totalPages = ceil($totalRows / $perPage);

$rows = [];

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
        "SELECT * FROM hotel ORDER BY SID LIMIT %s , %s",
        ($page - 1) * $perPage,
        $perPage
    );
    $row = $pdo->query($sql)->fetchAll();
}

$output = [
    'totalRows' => $totalRows,
    'totalPages' => $totalPages,
    'page' => $page,
    'rows' => $row,
    'perPage' => $perPage,
];



?>

<div class="container mt-3">
    <div class="row">
        <div class="col">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">分類代號</th>
                        <th scope="col">地區代號</th>
                        <th scope="col">飯店名稱</th>
                        <th scope="col">飯店代碼</th>
                        <th scope="col">飯店電話</th>
                        <th scope="col">飯店地址</th>
                        <th scope="col">飯店圖片</th>
                        <th scope="col">WIFI</th>
                        <th scope="col">早餐</th>
                        <th scope="col">午餐</th>
                        <th scope="col">晚餐</th>
                        <th scope="col">入住時間</th>
                        <th scope="col">退房時間</th>
                        <th scope="col">特殊設施</th>
                        <th scope="col">飯店描述</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($row as $r) : ?>
                        <tr>
                            <td><?= $r['sid'] ?></td>
                            <td><?= $r['categories_sid'] ?></td>
                            <td><?= $r['area_sid'] ?></td>
                            <td><?= $r['hotel_name'] ?></td>
                            <td><?= $r['hotel_code'] ?></td>
                            <td><?= $r['phone'] ?></td>
                            <td><?= $r['address'] ?></td>
                            <td><?= $r['picture'] ?></td>
                            <td><?= $r['wifi'] ?></td>
                            <td><?= $r['breakfast'] ?></td>
                            <td><?= $r['lunch'] ?></td>
                            <td><?= $r['dinner'] ?></td>
                            <td><?= $r['check_in'] ?></td>
                            <td><?= $r['check_out'] ?></td>
                            <td><?= $r['facility'] ?></td>
                            <td><?= $r['tag'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="justify-content-center mt-3">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page - 1 ?>">
                            <i class="fa-solid fa-circle-arrow-left"></i>
                        </a>
                    </li>

                    <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
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
                </ul>
            </nav>
        </div>
    </div>
</div>