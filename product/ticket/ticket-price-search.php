<?php 
 require __DIR__ . '/../../parts/connect_db.php';
// require __DIR__ . '/../../parts/connect_huang_db.php'; 

//$perPage = 30; //一頁幾筆
//$page = isset($_GET['page']) ? intval($_GET['page']) : 1; //第幾頁,有被設定就選那頁,沒有就第1頁

//算資料總比數
//$t_sql = "SELECT COUNT(1) FROM tickets ";

//query資料庫溝通
//$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

//$totalPages = ceil($totalRows / $perPage);
//ceil 天花板 floor 地板,


$rows = []; //預設給他一個陣列
$min_p = $_GET['min_p'];
$max_p = $_GET['max_p'];
$location = $_GET['location'];

//如果有資料,做判別
// if ($totalRows) {
//     if ($page < 1) {
//         header('Location: ?page=1');
//         exit;
//     }
//     if ($page > $totalPages) {
//         header('Location: ?page=' . $totalPages);
//         exit;
//     }

    $sql = "SELECT * FROM tickets 
    JOIN `area` 
    ON `tickets`.`cities_id` = `area`.`area_sid`
    JOIN `city`
    ON `area`.`city_sid` = `city`.`city_sid`
    JOIN `tickets_categories`
    ON `tickets`.`categories_id` = `tickets_categories`.`id`
    JOIN `listing_status`
    ON `tickets`.`on_sale` = `listing_status`.`status_sid`
    WHERE
    `city`.`city_name` LIKE '%$location%'
    AND
    `product_price` 
    BETWEEN '$min_p' AND '$max_p'
   
    ORDER BY PRODUCT_PRICE ASC";
    //第1個參數%s, 索引值 ;第2個參數%s抓幾個   DESC降冪 ASC升冪

    $rows = $pdo->query($sql)->fetchAll();


$output = [
    // 'totalRows' => $totalRows,
    // 'totalPages' => $totalPages,
    // 'page' => $page,
    'rows' => $rows,
    // 'perPage' => $perPage,
];
?>

<?php require __DIR__ . '/../../parts/html-head.php'; ?>
<?php include __DIR__ . '/../../parts/navbar.php'; ?>
<div class="container">
<form action="ticket-price-search.php">
            <input type="text" name="search" class="searchbar" >
            <button type="submit">Search</button>
</form>
    <div class="row">
        <div class="col">
            <!-- <nav aria-label="Page navigation example">
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
        
        <button type="button" class="btn btn-light" onclick="location.href='ticket-insert-form.php'">新增商品</button> -->

    <!-- </div> -->


    <div class="row">
    <div class="col">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">
                        <i class="fa-solid fa-trash-can"></i>
                    </th>
                    <th scope="col">#</th>
                    <th scope="col">票券代號</th>
                    <th scope="col">票券名稱</th>
                    <th scope="col">價錢</th>
                    <th scope="col">介紹</th>
                    <th scope="col">注意說明</th>
                    <th scope="col">開始日</th>
                    <th scope="col">結束日</th>
                    <th scope="col">封面圖片</th>
                    <th scope="col">產品圖片</th>
                    <th scope="col">分類</th>
                    <th scope="col">所在縣市</th>
                    <th scope="col">所在行政區</th>
                    <th scope="col">狀態</th>
                    <th scope="col">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </th>
            </thead>
            <tbody>
                <?php foreach ($rows as $r) : ?>
                    <tr>
                        <td>
                            <a href="javascript: delete_it(<?= $r['sid'] ?>)">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </td>

                        <td><?= $r['sid'] ?></td>
                        <td><?= $r['product_number'] ?></td>
                        <td><?= $r['product_name'] ?></td>
                        <td><?= $r['product_price'] ?></td>
                        <td><?= $r['product_introduction'] ?></td>
                        <td><?= $r['product_notice'] ?></td>
                        <td><?= $r['start_day'] ?></td>
                        <td><?= $r['end_day'] ?></td>
                        <!-- 封面圖片 -->
                        <td><img style="width: 100px;" src="../../imgs/tickets_imgs/<?= $r['product_cover'] ?>" alt=""></td>
                        <!-- 產品圖片 -->
                        <td><img style="width: 100px;" src="../../imgs/tickets_imgs/<?= $r['product_imgs'] ?>" alt=""></td>

                        <td><?= $r['classname'] ?></td>
                        <td><?= $r['city_name'] ?></td>
                        <td><?= $r['area_name'] ?></td>
                        <td><?= $r['status'] ?></td>

                        <td>
                            <a href="ticket-edit-form.php?sid=<?= $r['sid'] ?>">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>
</div>


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