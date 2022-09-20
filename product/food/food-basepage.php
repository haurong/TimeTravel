<?php require __DIR__ . '/../../parts/connect_db.php'; 
$pageName = 'basepage';

?>
<?php include __DIR__ . '/../../parts/html-head.php'; ?>
<?php include __DIR__ . '/../../parts/navbar.php'; ?>

<div class="container-fluid">
    <div class="btn-group-vertical col-2 my-3" role="group" aria-label="Vertical button group">
        <a type="button" class="btn btn-outline-dark py-2" href="./../food/food-list.php">所有商品</a>
        <a type="button" class="btn btn-outline-dark py-2" href="./food-insert-form.php">新增商品</a>  
        <a type="button" class="btn btn-outline-dark py-2" href="./food-list.php">編輯商品</a>  
        <a type="button" class="btn btn-outline-dark py-2" href="./food-list.php">刪除商品</a>  
    </div>
</div>



<?php include __DIR__ . '/../../parts/script.php';?>
<?php include __DIR__ . '/../../parts/html-foot.php'; ?>