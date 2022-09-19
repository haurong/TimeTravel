<?php require __DIR__ . '/../../parts/connect_db.php';


$t_sql = "SELECT COUNT(1) FROM tickets ";


$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

echo json_encode($totalRows);
exit;

?>

<?php require __DIR__ . '/../../parts/html-head.php'; ?>


<?php include __DIR__ . '/../../parts/navbar.php'; ?>
<div class="container">
<div class="row">
        <div class="col">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?= 1==$page ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page-1 ?>">
                            <i class="fa-solid fa-circle-arrow-left"></i>
                        </a>
                    </li>

                    <?php for($i= $page-4; $i<=$page+4; $i++): 
                        if($i >= 1 and $i <= $totalPages):   
                    ?>
                        <li class="page-item <?= $i==$page ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php 
                        endif;
                endfor; ?>

                    <li class="page-item <?= $totalPages==$page ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page+1 ?>">
                            <i class="fa-solid fa-circle-arrow-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <?php 

    if(empty($_SESSION['admin'])){
            include __DIR__. './product/ticket/list-table-no-admin.php';
        } else {
            include __DIR__. './product/ticket/list-table-admin.php';
        }
    ?>


<?php include __DIR__ . '/../../parts/script.php'; ?>

<?php include __DIR__ . '/../../parts/html-foot.php'; ?>