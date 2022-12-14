<?php
// require __DIR__ . '/parts/admin-required.php';

require __DIR__ . '/../../parts/connect_db.php';
// require __DIR__ . '/../../parts/connect_huang_db.php';
$pageName = 'edit';


$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if (empty($sid)) {
    header('Location: ticket-list.php');
    exit;
}

$sql = "SELECT * FROM tickets WHERE sid=$sid";
$r = $pdo->query($sql)->fetch();
if (empty($r)) {
    header('Location: ticket-list.php');
    exit;
}

?>

<?php require __DIR__ . '/../../parts/html-head.php'; ?>
<?php include __DIR__ . '/../../parts/navbar.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">

                <div class="card-body">
                    <h5 class="card-title">修改資料</h5>
                    <form name="form1" onsubmit="checkForm(); return false;">
                        <input type="hidden" name="sid" value="<?= $r['sid'] ?>">

                        <div class="mb-3">
                            <label for="product_number" class="form-label">票券代號</label>
                            <input type="text" class="form-control" id="product_number" name="product_number" required value="<?= htmlentities($r['product_number']) ?>">
                        </div>

                        <div class="mb-3">
                            <label for="product_name" class="form-label">票券名稱</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" value="<?= $r['product_name'] ?>">
                        </div>

                        <div class="mb-3">
                            <label for="product_price" class="form-label">價格</label>
                            <input type="text" class="form-control" id="product_price" name="product_price" value="<?= $r['product_price'] ?>">
                        </div>

                        <div class="mb-3">
                            <label for="product_introduction" class="form-label">介紹</label>
                            <textarea class="form-control" name="product_introduction" id="product_introduction" cols="50" rows="3"><?= $r['product_introduction'] ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="product_notice" class="form-label">注意說明</label>
                            <textarea class="form-control" name="product_notice" id="product_notice" cols="50" rows="3"><?= $r['product_notice'] ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="start_day" class="form-label">開始日</label>
                            <input type="date" class="form-control" id="start_day" name="start_day" value="<?= $r['start_day'] ?>">
                        </div>

                        <div class="mb-3">
                            <label for="end_day" class="form-label">結束日</label>
                            <input type="date" class="form-control" id="end_day" name="end_day" value="<?= $r['end_day'] ?>">
                        </div>

                        <div class="mb-3">
                            <label for="product_cover" class="form-label">封面圖片</label>
                            <input type="text" class="form-control" id="product_cover" name="product_cover" value="<?= $r['product_cover'] ?>" readonly>

                            <button type="button" class="btn btn-outline-info mt-3" id="picturebtn" onclick="realpicture.click()">上傳圖片</button>
                        </div>

                        <div class="mb-3">
                            <label for="product_imgs" class="form-label">介紹圖片</label>
                            <input type="text" class="form-control" id="product_imgs" name="product_imgs" value="<?= $r['product_imgs'] ?>" readonly>

                            <button type="button" class="btn btn-outline-info mt-3" id="picturebtn" onclick="realpicture2.click()">上傳圖片</button>
                        </div>

                        <div class="mb-3">
                            <label for="categories_id" class="form-label">類別</label>
                            <select type="text" class="form-control" id="cateOption" name="categories_id"></select>
                        </div>

                        <div class="mb-3">
                            <label for="citylocation" class="form-label">縣市名稱</label>
                            <br>
                            <select id="citysel"></select>
                        </div>

                        <div class="mb-3">
                            <label for="arealocation" class="form-label">區域名稱</label>
                            <br>
                            <select type="text" name="cities_id" id="areasel" ?>"></select>
                        </div>



                        <div class="mb-3">
                            <label class="form-label">上下架狀態:&nbsp</label>
                            <label class="form-label " for="onsale">上架</label>
                            <input type="radio" name="on_sale" value="1" id="sale" require>
                            <label class="form-label " for="onsale">下架</label>
                            <input type="radio" name="on_sale" value="2" id="notsale" require>
                        </div>

                        <button type="submit" class="btn btn-primary" id="btn">Submit</button>
                    </form>
                    <form action="" name="form_for_picture" style="display: none;">
                                <input type="file" name="realpicture" id="realpicture" accept="image/png , image/jpeg" style="display: none;">
                    </form> 
                    <form action="" name="form_for_picture2" style="display: none;">
                                <input type="file" name="realpicture2" id="realpicture2" accept="image/png , image/jpeg" style="display: none;">
                    </form> 

                </div>
            </div>

        </div>
    </div>

</div>

<?php include __DIR__ . '/../../parts/script.php'; ?>
<script src="tickets.js"></script>
<script>
    let cateOption = document.getElementById('cateOption');
    let sale = document.getElementById('sale');
    let notsale = document.getElementById('notsale');
    let citylocation = document.getElementById('citylocation');
    let arealocation = document.getElementById('arealocation');
    let btn = document.getElementById('btn');

    let realpicture = document.getElementById('realpicture');
    let product_cover = document.getElementById('product_cover');

    let realpicture2 = document.getElementById('realpicture2');
    let product_imgs = document.getElementById('product_imgs');

    // 票券種類
    ticketsCategories.forEach(function(value, index, array) {
        let {
            classname,
            id
        } = value;
        cateOption[index] = new Option(classname, id);

        if ((cateOption[index].value) == <?= $r['categories_id'] ?>) {
            cateOption[index].setAttribute('selected', 'selected')
        }
    })

    /*上下架狀態by選單*/
    // onSale.forEach(function(value,index,array){
    //     let {status, status_sid} = value;
    //     on_sale[index] = new Option(status, status_sid);

    //     if((on_sale[index]).value == ['on_sale'] ?>){
    //         on_sale[index].setAttribute('selected', 'selected')
    //     }
    // })

    /*上下架狀態by radio*/
    if ('<?= $r['on_sale'] ?>' == "1") {
        sale.checked = true;
    } else if ('<?= $r['on_sale'] ?>' == "2") {
        notsale.checked = true;
    }
    /*地區選單*/
    county.forEach(function(value,index,array){
        let {city_name,city_sid} = value
        citysel[index] = new Option(city_name,city_sid)
        let a = area.filter(function(value,index,array){
            return value.area_sid == <?= $r['cities_id'] ?>
        })
        if((citysel[index].value) == (a[0].city_sid)){
            citysel[index].setAttribute('selected','selected')
        }
    })


    let firstarea = area.filter(function(value,index,array){
        return value.city_sid == (citysel.selectedIndex) + 1   
    })

    // console.log(firstarea);


    firstarea.forEach(function(value,index,array){
        let { area_name , area_sid} = value
        areasel[index] = new Option(area_name,area_sid)
        if((areasel[index].value) == <?= $r['cities_id'] ?>){
            // console.log(areasel[index]);
            areasel[index].setAttribute('selected','selected')
        }
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

    // 產品封面
    realpicture.addEventListener('change',function(){
        console.log(realpicture.files);
        let fd_for_pic = new FormData(document.form_for_picture)
        // for (let fdfp of fd_for_pic.keys()) {
        //     console.log(`${fdfp}:${fd_for_pic.get(fdfp)}`);
        // }
        fetch('img-upload-api.php',{
            method:'POST',
            body:fd_for_pic,
        }).then(function(fdfp_r){
            return fdfp_r.json()
        }).then(function(fdfp_obj){
            // console.log(fdfp_obj.filename);
            product_cover.value = fdfp_obj.filename
        })
    })

    // 介紹圖片
    realpicture2.addEventListener('change',function(){
        console.log(realpicture2.files);
        let fd_for_pic = new FormData(document.form_for_picture2)
        // for (let fdfp of fd_for_pic.keys()) {
        //     console.log(`${fdfp}:${fd_for_pic.get(fdfp)}`);
        // }
        fetch('img-upload-api2.php',{
            method:'POST',
            body:fd_for_pic,
        }).then(function(fdfp_r){
            return fdfp_r.json()
        }).then(function(fdfp_obj){
            //console.log(fdfp_obj.filename);
            product_imgs.value = fdfp_obj.filename
        })
    })



    function checkForm() {

        const fd = new FormData(document.form1);

        for (let k of fd.keys()) {
            console.log(`${k}: ${fd.get(k)}`);
        }

        fetch('ticket-edit-api.php', {
            method: 'POST',
            body: fd
        }).then(r => r.json()).then(obj => {
            console.log(obj);
            if (!obj.success) {
                alert(obj.error);
            } else {
                alert('修改成功');
                location.href = 'ticket-list.php';
                //改完回列表↑
            }
        });
    }
</script>
<?php include __DIR__ . '/../../parts/html-foot.php'; ?>