<?php require __DIR__ . '/../../parts/connect_db.php';

$pageName = 'edit';
$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if (empty($sid)) {
    header('Location:stays.php');
    exit;
}
$sql = "SELECT * FROM hotel WHERE sid=$sid";
$r = $pdo->query($sql)->fetch();
if (empty($r)) {
    header('Location:stays.php');
    exit;
}
?>
<?php include __DIR__ . '/../../parts/html-head.php'; ?>
<?php include __DIR__ . '/../../parts/navbar.php'; ?>
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">修改資料</h5>
                    <form name="form1" onsubmit="checkForm(); return false;">
                        <input type="hidden" name="sid" value="<?= $r['sid'] ?>">
                        <div class="mb-3">
                            <label for="categories_sid" class="form-label">飯店種類</label>
                            <br>
                            <select type="text" name="categories_sid" id="categoriessel">
                            </select>
                        </div>
                        <!-- <div class="mb-3">
                            <label for="city_name" class="form-label">縣市名稱</label>
                            <br>
                            <select name="city_name" id="cityname"></select>
                        </div> -->
                        <div class="mb-3">
                            <label for="area_sid" class="form-label">地區名稱</label>
                            <br>
                            <select type="text" name="area_sid" id="areasel" value="<?= $r['area_sid'] ?>"></select>
                        </div>
                        <div class="mb-3">
                            <label for="hotel_name" class="form-label">飯店名稱</label>
                            <input type="text" class="form-control" id="hotel_name" name="hotel_name" value="<?= $r['hotel_name'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="hotel_code" class="form-label">飯店代碼</label>
                            <input type="text" class="form-control" id="hotel_code" name="hotel_code" value="<?= $r['hotel_code'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">飯店電話</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?= $r['phone'] ?>"> 
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">飯店地址</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?= $r['address'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="picture" class="form-label">飯店圖片</label>
                            <input type="text" class="form-control" id="picture" name="picture" value="<?= $r['picture'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label mr-5">WIFI</label>
                            <label class="form-label " for="wifitrue">有</label>
                            <input type="radio" name="wifi" value="TRUE" id="wifitrue">
                            <label class="form-label ml-5" for="wififalse">沒有</label>
                            <input type="radio" name="wifi" value="FALSE" id="wififalse">
                            <br>
                            <label class="form-label mr-5">早餐</label>
                            <label class="form-label " for="breakfasttrue">有</label>
                            <input type="radio" name="breakfast" value="TRUE" id="breakfasttrue">
                            <label class="form-label ml-5" for="breakfastfalse">沒有</label>
                            <input type="radio" name="breakfast" value="FALSE" id="breakfastfalse">
                            <br>
                            <label class="form-label mr-5">午餐</label>
                            <label class="form-label " for="lunchtrue">有</label>
                            <input type="radio" name="lunch" value="TRUE" id="lunchtrue">
                            <label class="form-label ml-5" for="lunchfalse">沒有</label>
                            <input type="radio" name="lunch" value="FALSE" id="lunchfalse">
                            <br>
                            <label class="form-label mr-5">晚餐</label>
                            <label class="form-label " for="dinnertrue">有</label>
                            <input type="radio" name="dinner" value="TRUE" id="dinnertrue">
                            <label class="form-label ml-5" for="dinnerfalse">沒有</label>
                            <input type="radio" name="dinner" value="FALSE" id="dinnerfalse">
                        </div>
                        <div class="mb-3">
                            <label for="check_in" class="form-label">入住時間</label>
                            <input type="text" name="check_in" id="check_in" value="<?= $r['check_in'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="check_out" class="form-label">退房時間</label>
                            <input type="text" name="check_out" id="check_out" value="<?= $r['check_out'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="facility" class="form-label">特殊設施</label>
                            <br>
                            <textarea name="facility" id="facility" cols="30" rows="3"><?= $r['facility'] ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="tag" class="form-label">飯店描述</label>
                            <br>
                            <textarea name="tag" id="tag" cols="30" rows="3"><?= $r['tag'] ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" id="submitbtn">更改</button>
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


    let wifitrue = document.getElementById('wifitrue')
    let wififalse = document.getElementById('wififalse')
    let breakfasttrue = document.getElementById('breakfasttrue')
    let breakfastfalse = document.getElementById('breakfastfalse')
    let lunchtrue = document.getElementById('lunchtrue')
    let lunchfalse = document.getElementById('lunchfalse')
    let dinnertrue = document.getElementById('dinnertrue')
    let dinnerfalse = document.getElementById('dinnerfalse')



    hotelcategories.forEach(function(value,index,array){
        let {hotel_categories,hotel_categories_sid} = value
        categoriessel[index] = new Option(hotel_categories,hotel_categories_sid)
        if((categoriessel[index].value) == <?= $r['categories_sid'] ?>){
            categoriessel[index].setAttribute('selected','selected')
        }
        
    })

    area.forEach(function(value,index,array){
        let { area_name , area_sid} = value
        areasel[index] = new Option(area_name,area_sid)
        if((areasel[index].value) == <?= $r['area_sid'] ?>){
            areasel[index].setAttribute('selected','selected')
        }
    })


    // console.log('<?= $r['wifi'] ?>');
    // console.log(wifitrue.checked);
    
    //確認 wifi 狀態
    if ('<?= $r['wifi'] ?>' == "TRUE"){
        wifitrue.checked = true
    }else if ('<?= $r['wifi'] ?>' !== "TRUE"){
        wififalse.checked = true
    }
    //確認 breakfast 狀態
    if ('<?= $r['breakfast'] ?>' == "TRUE"){
        breakfasttrue.checked = true
    }else if ('<?= $r['breakfast'] ?>' !== "TRUE"){
        breakfastfalse.checked = true
    }
    //確認 lunch 狀態
    if ('<?= $r['lunch'] ?>' == "TRUE"){
        lunchtrue.checked = true
    }else if ('<?= $r['lunch'] ?>' !== "TRUE"){
        lunchfalse.checked = true
    }
    //確認 dinner 狀態
    if ('<?= $r['dinner'] ?>' == "TRUE"){
        dinnertrue.checked = true
    }else if ('<?= $r['dinner'] ?>' !== "TRUE"){
        dinnerfalse.checked = true
    }


    function checkForm() {
        let fd = new FormData(document.form1);
        for (let k of fd.keys()) {
            console.log(`${k}:${fd.get(k)}`);
        }
        fetch('stays-editapi.php', {
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
                    alert('更改成功')
                    location.href = 'stays.php';
                }
            })
    }
</script>


<?php include __DIR__ . '/../../parts/script.php'; ?>
<?php include __DIR__ . '/../../parts/html-foot.php'; ?>