<?php require __DIR__ . '/../../parts/connect_db.php';
$pageName = 'site_insert';
?>
<?php require __DIR__ . '/../../parts/html-head.php'; ?>
<?php include __DIR__ . '/../../parts/navbar.php'; ?>

<div class="container">
    <div class="row">
        <form>
            <h2>新增景點</h2>

            <div class="form-group">
                <label for="name">景點名稱</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-row">
                <!-- <div class="mb-3">
                    <label for="city_name" class="form-label">縣市名稱</label>
                    <br>
                    <select name="city_name" id="citysel" name="city_sid"></select>
                </div> -->
                <div class="mb-3">
                    <label for="area_sid" class="form-label">地區名稱</label>
                    <br>
                    <select name="area_sid" id="areasel" name="area_sid"></select>
                </div>
            </div>
            <div class="form-group">
                <label for="name">景點分類</label>
                <br>
                <select name="site_category_sid" id="catesel" name="site_category_sid"></select>
            </div>
            <div class="form-group">
                <label for="name">景點描述</label>
                <input type="text" class="form-control" id="description" name="description">
            </div>
            <div class="form-group">
                <label for="img_small">圖片</label>
                <input type="file" id="img_small" name="img_small">
            </div>
            <div class="form-group">
                <label for="website">外部網站</label>
                <input type="text" class="form-control" id="website" name="website">
            </div>
            <div class="form-group">
                <label for="map">地圖</label>
                <input type="text" class="form-control" id="map" name="map">
            </div>

            

            <button type="submit" class="btn btn-primary">確認並送出</button>
            <button type="button" class="btn btn-primary" onclick="history.back()">回上一頁</button>
        </form>
    </div>
</div>




<?php include __DIR__ . '/../../parts/script.php'; ?>
<script>
    // let categoriessel = document.getElementById('categoriessel')
    // let citysel = document.getElementById('citysel')
    // let areasel = document.getElementById('areasel')
    // let submitbtn = document.getElementById('submitbtn')

    // hotelcategories.forEach(function(value, index, array) {
    //     let {
    //         hotel_categories,
    //         hotel_categories_sid
    //     } = value
    //     categoriessel[index] = new Option(hotel_categories, hotel_categories_sid)
    // })

    // area.forEach(function(value, index, array) {
    //     let {
    //         area_name,
    //         area_sid
    //     } = value
    //     areasel[index] = new Option(area_name, area_sid)
    // })








    function checkForm() {
        // document.form1.email.value

        const fd = new FormData(document.form1);

        for (let k of fd.keys()) {
            console.log(`${k}: ${fd.get(k)}`);
        }
        // TODO: 檢查欄位資料

        fetch('insert-api.php', {
            method: 'POST',
            body: fd
        }).then(r => r.json()).then(obj => {
            console.log(obj);
            if (!obj.success) {
                alert(obj.error);
            } else {
                alert('新增成功')
                location.href = 'list.php';
            }
        })


    }
</script>
<?php include __DIR__ . '/../../parts/html-foot.php'; ?>