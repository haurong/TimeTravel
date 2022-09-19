<?php 
require __DIR__ . '/../../parts/connect_db.php';
$pageName = 'food-list';

$perPage = 5; // 一頁有幾筆
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
         LEFT JOIN `food_categories` ON `food_product_all`.`categories_sid` = `food_categories`.`sid`
         LEFT JOIN `listing_status` ON `food_product_all`.`listing_status_sid`= `listing_status`.`sid`
         ORDER BY `food_product_all`.`product_number`",
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


// echo json_encode($output); exit;

?>
<?php require __DIR__ . '/../../parts/html-head.php'; ?>
<?php include __DIR__ . '/../../parts/navbar.php'; ?>
<div class="container-fluid p-4">
      
        <div class="col">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">
                        <i class="fa-solid fa-trash-can"></i>
                    </th>
                    <th scope="col">#</th> 
                    <th scope="col">產品編號</th>
                    <th scope="col">產品名稱</th>
                    <th scope="col">產品實際售價</th>
                    <th scope="col">產品面額</th>
                    <th scope="col">產品照片</th>
                    <th scope="col">適用商家</th>
                    <th scope="col">產品描述</th>
                    <th scope="col">商家營業時間</th>
                    <th scope="col">商家地址</th>
                    <th scope="col">上架狀態</th>
                    <th scope="col">分類</th>
                    <th scope="col">縣市</th>
                    <th scope="col">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </th>
                </tr>
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
                            <td><?= $r['p_selling_price'] ?></td>
                            <td><?= $r['p_discounted_price'] ?></td>
                            <td><img width=200 src="./../../imgs/<?= $r['product_photo'] ?>" alt=""></td>
                            <td><?= $r['applicable_store'] ?></td>
                            <td><?= $r['product_introdution'] ?></td>
                            <td><?= $r['p_business_hours'] ?></td>
                            <td><?= $r['product_address'] ?></td>
                            <td><?= $r['status'] ?></td>
                            <td><?= $r['name'] ?></td>
                            <td><?= $r['city_name'] ?></td>
                        <td>
                            <a href="food-edit-form.php?sid=<?= $r['sid'] ?>">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="col m-auto">
            <nav aria-label="Page navigation example  ">
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
<?php include __DIR__ . '/../../parts/script.php'; ?>
<script>
    const table = document.querySelector('table');

    function delete_it(sid){
        if(confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)){
            location.href = `food-delete.php?sid=${sid}`;
        }
    }
    /*
    table.addEventListener('click', function(event){
        const t = event.target;
        console.log(event.target);
        if(t.classList.contains('fa-trash-can')){
            t.closest('tr').remove();
        }
        if(t.classList.contains('fa-pen-to-square')){
            // console.log(t.closest('tr').querySelectorAll('td'));
            
            console.log( 
                t.closest('tr').querySelectorAll('td')[2].innerHTML
            );
            
        }
    });
    */

</script>
<?php include __DIR__ . '/../../parts/html-foot.php'; ?>