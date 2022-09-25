<?php include __DIR__ . '/../../parts/html-head.php'; ?>
<?php include __DIR__ . '/../../parts/navbar.php'; ?>
<style>
</style>


<?php
//  在別的地方是 connect_athome_db.php
//  原本是   connect_db.php
require __DIR__ . '/../../parts/connect_db.php'; 

$ascordesc = $_COOKIE['ascordesc'];

$rows = [];
$search = $_GET['search'];
$sql ="SELECT * 
FROM `hotel` 
JOIN `area` 
ON `hotel`.`area_sid` = `area`.`area_sid` 
JOIN `city`
ON `area`.`city_sid` = `city`.`city_sid`
JOIN `hotel_categories`
ON `hotel`.`categories_sid` = `hotel_categories`.`hotel_categories_sid`
WHERE 
`sid` like '%$search%'
or `city`.`city_name` LIKE '%$search%'
OR `area`.`area_name` LIKE '%$search%'
OR `hotel_name` LIKE '%$search%'
OR `hotel_code` LIKE '%$search%'
OR `phone` LIKE '%$search%'
OR `address` LIKE '%$search%'
OR `picture` LIKE '%$search%'
OR `wifi` LIKE '%$search%'
OR `breakfast` LIKE '%$search%'
OR `lunch` LIKE '%$search%'
OR `dinner` LIKE '%$search%'
OR `check_in` LIKE '%$search%'
OR `check_out` LIKE '%$search%'
OR `facility` LIKE '%$search%'
OR `tag` LIKE '%$search%'
ORDER BY SID $ascordesc";
    

if($search == 'wifi'){
    $sql = "SELECT * 
    FROM `hotel` 
    JOIN `area` ON `hotel`.`area_sid` = `area`.`area_sid` 
    JOIN `city` ON `area`.`city_sid` = `city`.`city_sid` 
    JOIN `hotel_categories` ON `hotel`.`categories_sid` = `hotel_categories`.`hotel_categories_sid` 
    WHERE `wifi` like 'TRUE'
    ORDER BY SID $ascordesc";
}else if ($search == '早餐'){
    $sql = "SELECT * 
    FROM `hotel` 
    JOIN `area` ON `hotel`.`area_sid` = `area`.`area_sid` 
    JOIN `city` ON `area`.`city_sid` = `city`.`city_sid` 
    JOIN `hotel_categories` ON `hotel`.`categories_sid` = `hotel_categories`.`hotel_categories_sid` 
    WHERE `breakfast` like 'TRUE'
    ORDER BY SID $ascordesc";
}else if ($search == '午餐'){
    $sql = "SELECT * 
    FROM `hotel` 
    JOIN `area` ON `hotel`.`area_sid` = `area`.`area_sid` 
    JOIN `city` ON `area`.`city_sid` = `city`.`city_sid` 
    JOIN `hotel_categories` ON `hotel`.`categories_sid` = `hotel_categories`.`hotel_categories_sid` 
    WHERE `lunch` like 'TRUE'
    ORDER BY SID $ascordesc";
}else if ($search == '晚餐'){
    $sql = "SELECT * 
    FROM `hotel` 
    JOIN `area` ON `hotel`.`area_sid` = `area`.`area_sid` 
    JOIN `city` ON `area`.`city_sid` = `city`.`city_sid` 
    JOIN `hotel_categories` ON `hotel`.`categories_sid` = `hotel_categories`.`hotel_categories_sid` 
    WHERE `dinner` like 'TRUE'
    ORDER BY SID $ascordesc";
}


$row = $pdo->query($sql)->fetchAll();



$output = [
    'rows' => $row,
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
        <form action="stays-search.php"  class="">
            <input type="text" name="search" class="searchbar"
            placeholder="請輸入關鍵字 也可輸入wifi或早餐或午餐或是晚餐">
            <button type="submit" class="btn btn-outline-success my-2 my-sm-0 submitbtn">Search</button>
        </form>
    </div>
    <div class="row justify-content-center d-flex align-items-center">
        <input type="button" class="btn btn-success" id="ascbtn" value="升冪"></input>
        <button type="button" class="btn btn-light" onclick="location.href='stays.php'">返回列表</button>
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



   
</div>

<script src="hotel.js"></script>
<script>
    function delete_it(sid) {
        if (confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)) {
            location.href = `stays-del.php?sid=${sid}`;
        }
    }
    let ascbtn = document.getElementById('ascbtn')

    if(('<?=$_COOKIE['ascordesc']?>') == 'ASC'){
            ascbtn.value ="升冪"
        }else if (('<?=$_COOKIE['ascordesc']?>') == 'DESC'){
            ascbtn.value ="降冪";
        }

    ascbtn.addEventListener('click',function(){
        if(ascbtn.value =="升冪"){
            ascbtn.value ="降冪";
            document.cookie = "ascordesc = DESC"
            console.log('<?=$_COOKIE['ascordesc']?>');
            location.reload()

            
        }else{
            ascbtn.value ="升冪"
            document.cookie = "ascordesc = ASC"
            console.log('<?=$_COOKIE['ascordesc']?>');
            location.reload()
        }
    })

</script>

<?php include __DIR__ . '/../../parts/script.php'; ?>
<?php include __DIR__ . '/../../parts/html-foot.php'; ?>