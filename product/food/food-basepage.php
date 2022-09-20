<?php require __DIR__ . '/../../parts/connect_db.php'; 
$pageName = 'basepage';

?>
<?php include __DIR__ . '/../../parts/html-head.php'; ?>
<?php include __DIR__ . '/../../parts/navbar.php'; ?>


<div class="container">
    <div class="btn-group-vertical col-2 my-3" role="group" aria-label="Vertical button group">
        <a type="button" class="btn btn-outline-dark py-2" href="./../food/food-list.php">特色小吃</a>
        <a type="button" class="btn btn-outline-dark py-2" href="./../food/food-list.php">台式料理</a>
        <a type="button" class="btn btn-outline-dark py-2" href="./../food/food-list.php">泰式料理</a>
        <a type="button" class="btn btn-outline-dark py-2" href="./../food/food-list.php">日式料理</a>
        <a type="button" class="btn btn-outline-dark py-2" href="./../food/food-list.php">火鍋</a>
        <a type="button" class="btn btn-outline-dark py-2" href="./../food/food-list.php">飲品</a>
        <a type="button" class="btn btn-outline-dark py-2" href="./../food/food-list.php">甜點</a>
        <a type="button" class="btn btn-outline-dark py-2" href="./../food/food-list.php">咖啡</a>
    </div>
</div>


<?php include __DIR__ . '/../../parts/script.php';?>
<?php include __DIR__ . '/../../parts/html-foot.php'; ?>