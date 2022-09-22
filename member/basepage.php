<?php require __DIR__ . '/../parts/connect_db.php'; 
$pageName = 'base';

?>

<?php include __DIR__ . '/../parts/html-head.php'; ?>
<?php include __DIR__ . '/../parts/navbar.php'; ?>

<div class="container">
    <div class="btn-group-vertical col-2 my-3" role="group" aria-label="Vertical button group">
        <a type="button" class="btn btn-outline-dark py-2" href="../product/itinerary/site-list.php">行程</a>
        <a type="button" class="btn btn-outline-dark py-2" href="../product/food/food-list.php">美食</a>
        <a type="button" class="btn btn-outline-dark py-2" href="../product/stays/stays.php">住宿</a>
        <a type="button" class="btn btn-outline-dark py-2" href="../product/ticket/ticket-list.php">票卷</a>
    </div>
</div>
<?php include __DIR__ . '/../parts/script.php';?>
<?php include __DIR__ . '/../parts/html-foot.php'; ?>