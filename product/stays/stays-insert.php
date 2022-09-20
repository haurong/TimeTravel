<?php require __DIR__ . '/../../parts/connect_athome_db.php';
$pageName = 'stays_insert';
$perPage = 40;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$t_sql = "SELECT COUNT(1) FROM hotel";

$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

$totalPages = ceil($totalRows / $perPage);
?>


<?php include __DIR__ . '/../../parts/html-head.php'; ?>
<?php include __DIR__ . '/../../parts/navbar.php'; ?>
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">新增資料</h5>
                    <form name="form1" onsubmit="checkForm(); return false;">
                        <div class="mb-3">
                            <label for="categories_sid" class="form-label">飯店種類</label>
                            <br>
                            <select name="categories_sid" id="categoriessel"></select>
                        </div>
                        <!-- <div class="mb-3">
                            <label for="city_name" class="form-label">縣市名稱</label>
                            <br>
                            <select name="city_name" id="cityname"></select>
                        </div> -->
                        <div class="mb-3">
                            <label for="area_sid" class="form-label">地區名稱</label>
                            <br>
                            <select name="area_sid" id="areasel"></select>
                        </div>
                        <div class="mb-3">
                            <label for="hotel_name" class="form-label">飯店名稱</label>
                            <input type="text" class="form-control" id="hotel_name" name="hotel_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="hotel_code" class="form-label">飯店代碼</label>
                            <input type="text" class="form-control" id="hotel_code" name="hotel_code">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">飯店電話</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">飯店地址</label>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>
                        <div class="mb-3">
                            <label for="picture" class="form-label">飯店圖片</label>
                            <input type="text" class="form-control" id="picture" name="picture">
                        </div>
                        <div class="mb-3">
                            <label for="wifi" class="form-label">WIFI</label>
                            <input type="text" class="form-control" id="wifi" name="wifi">
                            <label for="breakfast" class="form-label">早餐</label>
                            <input type="text" class="form-control" id="breakfast" name="breakfast">
                            <label for="lunch" class="form-label">午餐</label>
                            <input type="text" class="form-control" id="lunch" name="lunch">
                            <label for="dinner" class="form-label">晚餐</label>
                            <input type="text" class="form-control" id="dinner" name="dinner">
                        </div>
                        <div class="mb-3">
                            <label for="check_in" class="form-label">入住時間</label>
                            <input type="text" name="check_in" id="check_in">
                        </div>
                        <div class="mb-3">
                            <label for="check_out" class="form-label">退房時間</label>
                            <input type="text" name="check_out" id="check_out">
                        </div>
                        <div class="mb-3">
                            <label for="facility" class="form-label">特殊設施</label>
                            <br>
                            <textarea name="facility" id="facility" cols="30" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="tag" class="form-label">飯店描述</label>
                            <br>
                            <textarea name="tag" id="tag" cols="30" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" id="submitbtn">新增</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="hotel.js"></script>
<script>
    let categoriessel = document.getElementById('categoriessel')
        let citysel = document.getElementById('citysel')
        let areasel = document.getElementById('areasel')
        let submitbtn = document.getElementById('submitbtn')

    hotelcategories.forEach(function(value,index,array){
            let {hotel_categories,hotel_categories_sid} = value
            categoriessel[index] = new Option(hotel_categories,hotel_categories_sid)
        })

    area.forEach(function(value,index,array){
        let { area_name , area_sid} = value
        areasel[index] = new Option(area_name,area_sid)
    })


   




    function checkForm() {
        let fd = new FormData(document.form1);
        for (let k of fd.keys()) {
            console.log(`${k}:${fd.get(k)}`);
        }
        fetch('stays-insertapi.php', {
                method: 'POST',
                body: fd
            })
            // .then(r=>r.json()).then(obj=>{
            //      console.log(obj);
            //     if(! obj.success){
            //         alert(obj.error);
            //     }
            //  })
            .then(function(f) {
                return f.json()
            }).then(function(obj) {
                console.log(obj.success);
                if (!obj.success) {
                    alert(obj.error);
                } else {
                    alert('新增成功')
                    // location.href = "stay.php?page= + <?=$totalPages?>"
                    location.href = 'stays.php?page=<?=$totalPages?>';
                }
            })
    }
</script>
<?php include __DIR__ . '/../../parts/script.php'; ?>
<?php include __DIR__ . '/../../parts/html-foot.php'; ?>