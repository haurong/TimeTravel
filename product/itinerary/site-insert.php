<?php require __DIR__ . '/../../parts/connect_db.php';
$pageName = 'site_insert';
?>
<!-- api -->

<?php require __DIR__ . '/../../parts/html-head.php'; ?>
<?php include __DIR__ . '/../../parts/navbar.php'; ?>

<div class="container">
    <div class="row">
        <form name="form1">
            <h2>新增景點</h2>

            <div class="form-group">
                <label for="name">景點名稱</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-row">
                <div class="mb-3 pr-2">
                    <label for="city_name" class="form-label">縣市名稱</label>
                    <br>
                    <select name="city_name" id="citysel" name="city_sid"></select>
                </div>
                <div class="mb-3">
                    <label for="area_sid" class="form-label">地區名稱</label>
                    <br>
                    <select name="area_sid" id="areasel"></select>
                </div>
            </div>
            <div class="form-group">
                <label for="name">景點分類</label>
                <br>
                <select name="site_category_sid" id="catesel"></select>
            </div>
            <div class="form-group">
                <label for="name">景點描述</label>
                <input type="text" class="form-control" id="description" name="description">
            </div>
            <div class="form-group">
                <label for="img_small">圖片</label>
                <input type="text" class="form-control" id="img_small" name="img_small" readonly>
                <button type="button" class="btn btn-outline-info mt-3" id="picturebtn" onclick="realpicture.click()">上傳圖片</button>

            </div>
            <div class="form-group">
                <label for="website">外部網站</label>
                <input type="text" class="form-control" id="website" name="website">
            </div>
            <div class="form-group">
                <label for="map">地圖</label>
                <input type="text" class="form-control" id="map" name="map">
            </div>



            <button type="submit" onclick="checkForm(); return false;" class="btn btn-primary">確認並送出</button>
            <button type="button" class="btn btn-primary" onclick="history.back()">回上一頁</button>
        </form>
        <form action="" name="form_for_picture" style="display: none;">
            <input type="file" name="realpicture" id="realpicture" accept="image/png , image/jpeg" style="display: none;">
        </form>
    </div>
</div>


<?php include __DIR__ . '/../../parts/script.php'; ?>
<script src="site.js"></script>
<script>
    let catessel = document.getElementById('catessel')
    let citysel = document.getElementById('citysel')
    let areasel = document.getElementById('areasel')

    cate.forEach((value, index, arry) => {
        let {
            site_category_name,
            site_category_sid
        } = value
        catesel[index] = new Option(site_category_name, site_category_sid)
    })

    county.forEach(function(value, index, array) {
        let {
            city_name,
            city_sid
        } = value
        citysel[index] = new Option(city_name, city_sid)
    })

    let firstarea = area.filter(function(value, index, array) {
        return value.city_sid == 1
    })
    firstarea.forEach(function(value, index, array) {
        let {
            area_name,
            area_sid
        } = value
        areasel[index] = new Option(area_name, area_sid)
    })

    citysel.addEventListener('change', function() {
        areasel.options.length = 0;
        citychoose = citysel.options[citysel.selectedIndex].value
        let areafilter = area.filter(function(value, index, array) {
            return value.city_sid == citychoose
        })
        areafilter.forEach(function(value, index, array) {
            let {
                area_name,
                area_sid
            } = value
            areasel[index] = new Option(area_name, area_sid)
        })
    })

    let realpicture = document.getElementById('realpicture')

    let img_small = document.getElementById('img_small')

    realpicture.addEventListener('change', function() {
        console.log(realpicture.files);
        let fd_for_pic = new FormData(document.form_for_picture)
        // for (let fdfp of fd_for_pic.keys()) {
        //     console.log(`${fdfp}:${fd_for_pic.get(fdfp)}`);
        // }
        fetch('uploadpicapi.php', {
            method: 'POST',
            body: fd_for_pic,
        }).then(function(fdfp_r) {
            return fdfp_r.json()
        }).then(function(fdfp_obj) {
            console.log(fdfp_obj);
            img_small.value = fdfp_obj.filename
        })
    })


    function checkForm() {
        const fd = new FormData(document.form1);
        for (let k of fd.keys()) {
            console.log(`${k}: ${fd.get(k)}`);
        }
        fetch('site-insert-api.php', {
            method: 'POST',
            body: fd
        }).then(r => r.json()).then(obj => {
            console.log(obj);
            if (!obj.success) {
                alert(obj.error);
            } else {
                alert('新增成功')
                location.href = 'site-list.php';
            }
        })
    }
</script>
<?php include __DIR__ . '/../../parts/html-foot.php'; ?>