<?php include __DIR__ . '/../../parts/html-head.php'; ?>
<?php include __DIR__ . '/../../parts/navbar.php'; ?>
<style>
</style>


<?php
//  在別的地方是 connect_athome_db.php
//  原本是   connect_db.php
require __DIR__ . '/../../parts/connect_db.php';

// $perPage = 40;

// $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// $t_sql = "SELECT COUNT(1) FROM hotel";

// $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

// $totalPages = ceil($totalRows / $perPage);

$rows = [];
$seach = $_GET['search'];
// if ($totalRows) {
//     if ($page < 1) {
//         header('Location: ?page=1');
//         exit;
//     }
//     if ($page > $totalPages) {
//         header('Location: ?page=' . $totalPages);
//         exit;
//     }
$sql ="SELECT * 
FROM `hotel` 
JOIN `area` 
ON `hotel`.`area_sid` = `area`.`area_sid` 
JOIN `city`
ON `area`.`city_sid` = `city`.`city_sid`
JOIN `hotel_categories`
ON `hotel`.`categories_sid` = `hotel_categories`.`hotel_categories_sid`
WHERE 
`sid` like '%$seach%'
or `city`.`city_name` LIKE '%$seach%'
OR `area`.`area_name` LIKE '%$seach%'
OR `hotel_name` LIKE '%$seach%'
OR `hotel_code` LIKE '%$seach%'
OR `phone` LIKE '%$seach%'
OR `address` LIKE '%$seach%'
OR `picture` LIKE '%$seach%'
OR `wifi` LIKE '%$seach%'
OR `breakfast` LIKE '%$seach%'
OR `lunch` LIKE '%$seach%'
OR `dinner` LIKE '%$seach%'
OR `check_in` LIKE '%$seach%'
OR `check_out` LIKE '%$seach%'
OR `facility` LIKE '%$seach%'
OR `tag` LIKE '%$seach%'
ORDER BY SID";
    

if($seach == 'wifi'){
    $sql = "SELECT * 
    FROM `hotel` 
    JOIN `area` ON `hotel`.`area_sid` = `area`.`area_sid` 
    JOIN `city` ON `area`.`city_sid` = `city`.`city_sid` 
    JOIN `hotel_categories` ON `hotel`.`categories_sid` = `hotel_categories`.`hotel_categories_sid` 
    WHERE `wifi` like 'TRUE'";
}else if ($seach == '早餐'){
    $sql = "SELECT * 
    FROM `hotel` 
    JOIN `area` ON `hotel`.`area_sid` = `area`.`area_sid` 
    JOIN `city` ON `area`.`city_sid` = `city`.`city_sid` 
    JOIN `hotel_categories` ON `hotel`.`categories_sid` = `hotel_categories`.`hotel_categories_sid` 
    WHERE `breakfast` like 'TRUE'";
}else if ($seach == '午餐'){
    $sql = "SELECT * 
    FROM `hotel` 
    JOIN `area` ON `hotel`.`area_sid` = `area`.`area_sid` 
    JOIN `city` ON `area`.`city_sid` = `city`.`city_sid` 
    JOIN `hotel_categories` ON `hotel`.`categories_sid` = `hotel_categories`.`hotel_categories_sid` 
    WHERE `lunch` like 'TRUE'";
}else if ($seach == '晚餐'){
    $sql = "SELECT * 
    FROM `hotel` 
    JOIN `area` ON `hotel`.`area_sid` = `area`.`area_sid` 
    JOIN `city` ON `area`.`city_sid` = `city`.`city_sid` 
    JOIN `hotel_categories` ON `hotel`.`categories_sid` = `hotel_categories`.`hotel_categories_sid` 
    WHERE `dinner` like 'TRUE'";
}


$row = $pdo->query($sql)->fetchAll();








    // ($page - 1) * $perPage,
    // $perPage
// $row = $pdo->query($sql)->fetchAll();
// }


$output = [
    // 'totalRows' => $totalRows,
    // 'totalPages' => $totalPages,
    // 'page' => $page,
    'rows' => $row,
    // 'perPage' => $perPage,
];



?>

<style>
    .searchbar{
        width: 600px;
        height: 50px;
    }
</style>

<div class="mx-5 mt-3">
    <div class="d-flex justify-content-center">
        <form action="stays-search.php">
            <input type="text" name="search" class="searchbar" placeholder="請輸入關鍵字 也可輸入wifi或早餐或午餐或是晚餐">
            <button type="submit">Search</button>
        </form>
    </div>
    <div class="row justify-content-center d-flex align-items-center">
        <!-- <div class="mt-3 d-flex  justify-content-center flex-grow-1">
            <nav aria-label="Page navigation example" class="d-flex">
                <ul class="pagination align-items-center">
                    <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=1">
                            最前頁
                        </a>
                    </li>
                    <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page - 1 ?>">
                            <i class="fa-solid fa-circle-arrow-left"></i>
                        </a>
                    </li>

                    <?php for ($i = $page - 10; $i <= $page + 10; $i++) :
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
        </div> -->
        <button type="button" class="btn btn-light" onclick="location.href='stays-insert.php'">新增</button>
    </div>


    <div class="row">
        <div class="col">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">
                            <i class="fa-solid fa-trash-can"></i>
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">分類</th>
                        <th scope="col">縣市名稱</th>
                        <th scope="col">地區名稱</th>
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
                        <th scope="col">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($row as $r) : ?>
                        <tr>
                            <td>
                                <a href="javascript: delete_it(<?= $r['sid'] ?>)">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </td>
                            <td><?= $r['sid'] ?></td>
                            <td><?= $r['hotel_categories'] ?></td>
                            <td><?= $r['city_name'] ?></td>
                            <td><?= $r['area_name'] ?></td>
                            <td><?= $r['hotel_name'] ?></td>
                            <td><?= $r['hotel_code'] ?></td>
                            <td><?= $r['phone'] ?></td>
                            <td><?= $r['address'] ?></td>
                            <td>
                                <img style="width:200px"src="/../TimeTravel/imgs/hotel/A/<?= $r['picture'] ?>">
                                    <?= $r['picture'] ?>
                                </img>
                            </td>
                            <td><?= $r['wifi'] ?></td>
                            <td><?= $r['breakfast'] ?></td>
                            <td><?= $r['lunch'] ?></td>
                            <td><?= $r['dinner'] ?></td>
                            <td><?= $r['check_in'] ?></td>
                            <td><?= $r['check_out'] ?></td>
                            <td><?= $r['facility'] ?></td>
                            <td><?= $r['tag'] ?></td>
                            <td>
                                <a href="stays-edit.php?sid=<?= $r['sid'] ?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>



    <!-- <div class="mt-3 d-flex  justify-content-center flex-grow-1">
            <nav aria-label="Page navigation example" class="d-flex">
                <ul class="pagination align-items-center">
                    <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=1">
                            最前頁
                        </a>
                    </li>
                    <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page - 1 ?>">
                            <i class="fa-solid fa-circle-arrow-left"></i>
                        </a>
                    </li>

                    <?php for ($i = $page - 10; $i <= $page + 10; $i++) :
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
        </div> -->
</div>

<script src="hotel.js"></script>
<script>
    // console.log(allhotel);
    function delete_it(sid) {
        if (confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)) {
            location.href = `stays-del.php?sid=${sid}`;
        }
    }
    console.log('<?= $_GET['search'] ?>');
</script>

<?php include __DIR__ . '/../../parts/script.php'; ?>
<?php include __DIR__ . '/../../parts/html-foot.php'; ?>