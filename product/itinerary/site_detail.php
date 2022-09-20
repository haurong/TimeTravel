<?php require __DIR__ . '/../../parts/connect_db.php';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
$sql = sprintf(
    "SELECT * FROM `site` 
    JOIN `area` ON `site`.`area_sid`=`area`.`area_sid` 
    JOIN `city` ON `area`.`city_sid`=`city`.`city_sid`
    JOIN `site_categories` ON `site`.`site_category_sid`=`site_categories`.`site_category_sid`
    WHERE `sid`= $sid"
);
$rows = $pdo->query($sql)->fetchAll();
// $r = $rows;


?>
<?php require __DIR__ . '/../../parts/html-head.php'; ?>
<?php include __DIR__ . '/../../parts/navbar.php'; ?>
<div class="container">
    <div class="btn-group-vertical col-2 my-3" role="group" aria-label="Vertical button group">
        <a type="button" class="btn btn-outline-dark py-2" href="../product-list.php">全部</a>
        <a type="button" class="btn btn-outline-dark py-2" href="../itinerary/itinerary.php">行程</a>
        <a type="button" class="btn btn-outline-dark py-2" href="../food/food.php">美食</a>
        <a type="button" class="btn btn-outline-dark py-2" href="../stays/stays.php">住宿</a>
        <a type="button" class="btn btn-outline-dark py-2" href="../ticket/ticket.php">票卷</a>
    </div>
    
<div class="container">
    <div class="row">
        <div class="col">
            <!-- <table class="table table-striped table-bordered">
            <?php foreach ($rows as $r) : ?>
                <h2><?= $r['name'] ?></h2>
                <?php endforeach; ?>
                <thead>
                    <tr>
                        <th scope="col">
                            <i class="fa-solid fa-trash-can"></i>
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">景點名稱</th>
                        <th scope="col">地區</th>
                        <th scope="col">分類</th>
                        <th scope="col">簡介</th>
                        <th scope="col">照片</th>
                        <th scope="col">網站</th>
                        <th scope="col">地圖</th>
                        <th scope="col">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $r) : ?>
                        <tr>
                            <td>
                                <a href="javascript: delete_it(<?= $r['sid'] ?>)" >
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </td>
                            <td><?= $r['sid'] ?></td>
                            <td><?= $r['name'] ?></td>
                            <td><?= $r['city_name'] ?><?= $r['area_name'] ?></td>
                            <td><?= $r['site_category_name'] ?></td>
                            <td><?= $r['description'] ?></td>
                            <td><img style="width: 200px;" src="./../../imgs/site/<?= $r['img_small'] ?>" alt=""></td>
                            <td><a href="<?= $r['website'] ?>">網站</a></td>
                            <td><iframe src="https://www.google.com/maps/embed?pb=<?= $r['map'] ?>!5m2!1szh-TW!2stw" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></td>
                            <td>
                                <a href="edit-form.php?sid=<?= $r['sid'] ?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table> -->

            <div class="card" style="width: 40%; display: flex;">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="./../../imgs/site/<?= $r['img_l1'] ?>" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="./../../imgs/site/<?= $r['img_l2'] ?>" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="./../../imgs/site/<?= $r['img_l3'] ?>" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <div class="card-body">

                    <?php foreach ($rows as $r) : ?>
                        <h2><?= $r['name'] ?></h2>
                        <h3><?= $r['city_name'] ?><?= $r['area_name'] ?></h3>
                        <h3><?= $r['site_category_name'] ?></h3>
                        <h3><?= $r['description'] ?></h3>
                        <h3><a href="<?= $r['website'] ?>">網站</a></h3>
                        <iframe src="https://www.google.com/maps/embed?pb=<?= $r['map'] ?>!5m2!1szh-TW!2stw" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>


                    <?php endforeach; ?>



                </div>
            </div>

        </div>
    </div>

</div>
<?php include __DIR__ . '/../../parts/script.php'; ?>
<script>
    // const table = document.querySelector('table');

    // function delete_it(sid){
    //     if(confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)){
    //         location.href = `delete.php?sid=${sid}`;
    //     }
    // }
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