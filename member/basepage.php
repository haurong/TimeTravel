<?php
require __DIR__ . '/../parts/connect_db.php'; 
// require __DIR__ . '/../parts/connect_athome_db.php';
$pageName = 'base';

?>

<?php include __DIR__ . '/../parts/html-head.php'; ?>
<?php include __DIR__ . '/../parts/navbar.php'; ?>
<style>
    .card-group {
        width: 80%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);

    }

    .card {
        box-shadow: 1px 1px 3px #ccc;
    }
</style>
<div class="container d-flex justify-content-center align-content-center">

    <div class="card-group m-1 ">
        <div class="card d-flex m-3 shadow p-3 mb-5 bg-white rounded">
            <img src="../member/base_img/itinerary_img.jpg" class="card-img-top" alt="...">
            <div class="card-body text-center">
                <button type="button" class="btn btn-link"><a href="./../product/./itinerary/./site-list.php">行程</a></button>
            </div>
        </div>
        <div class="card d-flex  m-3 shadow p-3 mb-5 bg-white rounded">
            <img src="../member/base_img/food_img.jpg" class="card-img-top" alt="...">
            <div class="card-body text-center">
                <button type="button" class="btn btn-link"><a href="./../product/./food/food-list.php">美食</a></button>
            </div>
        </div>
        <div class="card d-flex m-3 shadow p-3 mb-5 bg-white rounded">
            <img src="../member/base_img/stays2_img.jpg" class="card-img-top" alt="...">
            <div class="card-body text-center">
                <button type="button" class="btn btn-link text-center "><a href="./../product/./stays/./stays.php">住宿</a></button>
            </div>
        </div>
        <div class="card d-flex  m-3 shadow p-3 mb-5 bg-white rounded">
            <img src="../member/base_img/ticket_img.jpg" class="card-img-top" alt="...">
            <div class="card-body text-center">
                <button type="button" class="btn btn-link text-center "><a href="./../product/./ticket/./ticket-list.php">票券</a></button>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../parts/script.php'; ?>
<?php include __DIR__ . '/../parts/html-foot.php'; ?>