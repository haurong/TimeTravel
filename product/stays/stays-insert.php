<?php require __DIR__ . '/../../parts/connect_db.php';
$pageName = 'stays_insert';
$perPage = 40;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$t_sql = "SELECT COUNT(1) FROM hotel";

$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

$totalPages = ceil($totalRows / $perPage);
$lastsql= "SELECT * 
            FROM `hotel` 
            WHERE 1
            order by sid DESC
            LIMIT 1";
$last = $pdo->query($lastsql)->fetch();
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
                        <div class="mb-3">
                            <label for="city_name" class="form-label">縣市名稱</label>
                            <br>
                            <select id="citysel"></select>
                        </div>
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
                            <input type="text" class="form-control" id="hotel_code" name="hotel_code" readonly>
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
                            <input type="text" class="form-control" id="picture" name="picture" readonly>

                            <button type="button" class="btn btn-outline-info mt-3" id="picturebtn" onclick="realpicture.click()">上傳圖片</button>
                        </div>
                        <div class="mb-3">
                            <label class="form-label mr-5">WIFI</label>
                            <label class="form-label " for="wifitrue">有</label>
                            <input type="radio" name="wifi" value="TRUE" id="wifitrue" >
                            <label class="form-label ml-5" for="wififalse">沒有</label>
                            <input type="radio" name="wifi" value="FALSE" id="wififalse">
                            <br>
                            <label class="form-label mr-5">早餐</label>
                            <label class="form-label " for="breakfasttrue">有</label>
                            <input type="radio" name="breakfast" value="TRUE" id="breakfasttrue" required>
                            <label class="form-label ml-5" for="breakfastfalse">沒有</label>
                            <input type="radio" name="breakfast" value="FALSE" id="breakfastfalse">
                            <br>
                            <label class="form-label mr-5">午餐</label>
                            <label class="form-label " for="lunchtrue">有</label>
                            <input type="radio" name="lunch" value="TRUE" id="lunchtrue" required>
                            <label class="form-label ml-5" for="lunchfalse">沒有</label>
                            <input type="radio" name="lunch" value="FALSE" id="lunchfalse">
                            <br>
                            <label class="form-label mr-5">晚餐</label>
                            <label class="form-label " for="dinnertrue">有</label>
                            <input type="radio" name="dinner" value="TRUE" id="dinnertrue" required>
                            <label class="form-label ml-5" for="dinnerfalse">沒有</label>
                            <input type="radio" name="dinner" value="FALSE" id="dinnerfalse">
                        </div>
                        <div class="mb-3">
                            <label for="check_in" class="form-label">入住時間</label>
                            <input type="time" name="check_in" id="check_in">
                        </div>
                        <div class="mb-3">
                            <label for="check_out" class="form-label">退房時間</label>
                            <input type="time" name="check_out" id="check_out">
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
                        <button type="submit" class="btn btn-primary" id="submitbtn"
                        onclick="">新增</button>
                    </form>
                    <form action="" name="form_for_picture" style="display: none;">
                        <input type="file" name="realpicture" id="realpicture" accept="image/png , image/jpeg" style="display: none;">
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
    let hotel_code = document.getElementById('hotel_code')

    let realpicture = document.getElementById('realpicture')

    let picture = document.getElementById('picture')

    let lastcode = "<?=$last['hotel_code']?>"
    console.log(lastcode);
    let A = lastcode.split('A')
    console.log(A);
    let lastnumber = Number(A[1])
    console.log(lastnumber);
    let lasthotelcode = "A"+ (lastnumber+1)
    console.log(lasthotelcode);
    hotel_code.value = lasthotelcode

    hotelcategories.forEach(function(value, index, array) {
        let {hotel_categories,hotel_categories_sid} = value
        categoriessel[index] = new Option(hotel_categories, hotel_categories_sid)
    })

    county.forEach(function(value,index,array){
            let {city_name,city_sid} = value
            citysel[index] = new Option(city_name,city_sid)
    })

    let firstarea = area.filter(function(value,index,array){
        return value.city_sid == 1
    })
    firstarea.forEach(function(value, index, array) {
        let {area_name,area_sid} = value
        areasel[index] = new Option(area_name, area_sid)
    })

    citysel.addEventListener('change',function(){
            areasel.options.length = 0;
            citychoose = citysel.options[citysel.selectedIndex].value
            let areafilter = area.filter(function(value,index,array){
                    return value.city_sid == citychoose
                })
            // console.log(areafilter);
            areafilter.forEach(function(value, index, array) {
            let {area_name,area_sid} = value
            areasel[index] = new Option(area_name, area_sid)
        })
    })

    realpicture.addEventListener('change',function(){
        console.log(realpicture.files);
        let fd_for_pic = new FormData(document.form_for_picture)
        // for (let fdfp of fd_for_pic.keys()) {
        //     console.log(`${fdfp}:${fd_for_pic.get(fdfp)}`);
        // }
        fetch('uploadpicapi.php',{
            method:'POST',
            body:fd_for_pic,
        }).then(function(fdfp_r){
            return fdfp_r.json()
        }).then(function(fdfp_obj){
            console.log(fdfp_obj);
            picture.value = fdfp_obj.filename
        })
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
                    // location.href = "stay.php?page= + <?= $totalPages ?>"
                    location.href = 'stays.php?page=<?= $totalPages ?>';
                }
            })
    }
</script>
<?php include __DIR__ . '/../../parts/script.php'; ?>
<?php include __DIR__ . '/../../parts/html-foot.php'; ?>