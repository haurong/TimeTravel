<?php
require __DIR__ . '/../parts/connect_athome_db.php';
// require __DIR__ . '/../parts/connect_db.php';
$pageName = 'member-list';

$perPage = 10; // 一頁有幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// 算總筆數
$t_sql = "SELECT COUNT(1) FROM member_information";

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
        "SELECT * FROM `member_information`
        JOIN `member_verification_status` ON `member_information`.`verification_sid` = `member_verification_status`.`verification_sid` 
        ORDER BY `member_information`.`sid`  LIMIT %s, %s",
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


// echo json_encode($output); exit;

?>
<?php require __DIR__ . '/../parts/html-head.php'; ?>
<?php include __DIR__ . '/../parts/navbar.php'; ?>
<div class="container-fluid p-4">
    <div class="d-flex justify-content-center">
        <nav aria-label="Page navigation example  justify-content-center">
            <ul class="pagination">
                <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=1">
                        最前
                    </a>
                </li>

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
                <li class="page-item <?= $totalPages == $page ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $totalPages ?>">
                        最後
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="col">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">會員編號</th>
                    <th scope="col">會員姓名</th>
                    <th scope="col">email</th>
                    <th scope="col">密碼</th>
                    <th scope="col">手機</th>
                    <th scope="col">登入時間</th>
                    <th scope="col">驗證狀態</th>
                    <th scope="col">創建時間</th>
                    <th scope="col">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </th>
                    <th scope="col">
                        <i class="fa-solid fa-trash-can"></i>
                    </th>
                </tr>
            </thead>
            <tbody>
                <!--foreach去抓底下的資料欄位-->
                <?php foreach ($rows as $r) : ?>
                    <tr>
                        <td><?= $r['sid'] ?></td>
                        <td><?= $r['userID'] ?></td>
                        <td><?= $r['username'] ?></td>
                        <td><?= $r['email'] ?></td>
                        <td><?= $r['password_hash'] ?></td>
                        <td><?= $r['telephone'] ?></td>
                        <td><?= $r['login_time'] ?></td>
                        <td><?= $r['VS_Name'] ?></td>
                        <td><?= $r['creating_time'] ?></td>
                        <td>
                            <a href="member-edit-form.php?sid=<?= $r['sid'] ?>">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </td>
                        <td>
                            <a href="javascript: 
                                    delete_it(<?= $r['sid'] ?>)">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<?php
//如果沒有登入的話
// if(empty($_SESSION['admin'])){
//連結到沒有權限的列表頁
//     include __DIR__. '/list-table-no-admin.php';
// } else {
//連結到有權限的列表頁  
//     include __DIR__. '/list-table-admin.php';
// }

?>


</div>
<?php include __DIR__ . '/../parts/script.php'; ?>
<script>
    function delete_it(sid) {
        if (confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)) {
            location.href = `member-delete.php?sid=${sid}`;
        }
    }
</script>
<?php include __DIR__ . '/../parts/html-foot.php'; ?>