<?php include __DIR__ . '/../../parts/html-head.php'; ?>
<?php include __DIR__ . '/../../parts/navbar.php'; ?>

<div class="container">
    <div class="btn-group-vertical col-2 my-3" role="group" aria-label="Vertical button group">
        <a type="button" class="btn btn-outline-dark py-2" href="../product-list.php">全部</a>
        <a type="button" class="btn btn-outline-dark py-2" href="../itinerary/itinerary.php">行程</a>
        <a type="button" class="btn btn-outline-dark py-2" href="../food/food.php">美食</a>
        <a type="button" class="btn btn-outline-dark py-2" href="../stays/stays.php">住宿</a>
        <a type="button" class="btn btn-outline-dark py-2" href="../ticket/ticket.php">票卷</a>
    </div>
</div>
<div class="container">
    <button type="button" class="btn btn-primary" onclick="location.href='site-list.php'">前往景點列表</button>
    <button type="button" class="btn btn-primary" onclick="location.href='site-insert.php'">新增景點</button>
    <button type="button" class="btn btn-primary" onclick="history.back()">回上一頁</button>
</div>

<?php include __DIR__ . '/../../parts/script.php'; ?>
<?php include __DIR__ . '/../../parts/html-foot.php'; ?>