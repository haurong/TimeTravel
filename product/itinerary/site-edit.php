<?php
// require __DIR__ . '/parts/admin-required.php';
require __DIR__ . '/../../parts/connect_db.php';
$pageName = 'edit';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if (empty($sid)) {
    // header('Location: site-list.php');
    // exit;
}

$sql = "SELECT * FROM site WHERE sid=$sid";
$r = $pdo->query($sql)->fetch();
if (empty($r)) {
    // header('Location: site-list.php');
    // exit;
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
                            <label for="name" class="form-label">景點名稱</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $r['name'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="area_sid" class="form-label">景點位置</label>
                            <select id="citysel"></select>
                            <select name="area_sid" id="areasel"value="<?= $r['area_sid'] ?>"></select>
                        </div>
                        <div class="mb-3">
                            <label for="site_category_sid" class="form-label">景點分類</label>
                            <select name="site_category_sid" id="catessel"value="<?= $r['site_category_name'] ?>"></select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">景點描述</label>
                            <input type="text" class="form-control" id="description" name="description" value="<?= $r['description'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="img_small">圖片</label>
                            <input type="text" id="img_small" name="img_small" value="<?= $r['img_small'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="website">外部網站</label>
                            <input type="text" class="form-control" id="website" name="website" value="<?= $r['website'] ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">送出更改</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<?php include __DIR__ . '/../../parts/script.php'; ?>
<script>
    function checkForm() {
        // document.form1.email.value

        const fd = new FormData(document.form1);

        for (let k of fd.keys()) {
            console.log(`${k}: ${fd.get(k)}`);
        }
        // TODO: 檢查欄位資料

        fetch('edit-api.php', {
            method: 'POST',
            body: fd
        }).then(r => r.json()).then(obj => {
            console.log(obj);
            if (!obj.success) {
                alert(obj.error);
            } else {
                alert('修改成功')
                // location.href = 'list.php';
            }
        })


    }
</script>
<script src="site.js"></script>
<script>
    let catessel = document.getElementById('catessel')
    let citysel = document.getElementById('citysel')
    let areasel = document.getElementById('areasel')

    cate.forEach((value, index, arry) => {
        let {site_category_name, site_category_sid} = value
        catessel[index] = new Option(site_category_name, site_category_sid)
        if((catessel[index].value) == <?= $r['site_category_sid'] ?>){
            catessel[index].setAttribute('selected','selected')
        }
    })

     county.forEach(function(value,index,array){
        let {city_name,city_sid} = value
        citysel[index] = new Option(city_name,city_sid)
        let a = area.filter(function(value,index,array){
            return value.area_sid == <?= $r['area_sid'] ?>
        })
        if((citysel[index].value) == (a[0].city_sid)){
            citysel[index].setAttribute('selected','selected')
        }
    })

    let firstarea = area.filter(function(value, index, array) {
        return value.city_sid == 1
    })
    firstarea.forEach(function(value, index, array) {
        let {area_name, area_sid} = value
        areasel[index] = new Option(area_name, area_sid)
        if((areasel[index].value) == <?= $r['area_sid'] ?>){
            areasel[index].setAttribute('selected','selected')
        }
    })

    citysel.addEventListener('change', function() {
        areasel.options.length = 0;
        citychoose = citysel.options[citysel.selectedIndex].value
        let areafilter = area.filter(function(value, index, array) {
            return value.city_sid == citychoose
        })
        areafilter.forEach(function(value, index, array) {
            let {area_name, area_sid} = value
            areasel[index] = new Option(area_name, area_sid)
        })
    })

    function checkForm() {
        const fd = new FormData(document.form1);
        for (let k of fd.keys()) {
            console.log(`${k}: ${fd.get(k)}`);
        }
        fetch('site-edit-api.php', {
            method: 'POST',
            body: fd
        })
        .then(function(f) {
                return f.json()
            }).then(function(obj) {
                console.log(obj.success);
                if (!obj.success) {
                    alert(obj.error);
                } else {
                    alert('更改成功')
                    location.href = 'site-list.php';
                }
            })

    }
</script>
<?php include __DIR__ . '/../../parts/html-foot.php'; ?>