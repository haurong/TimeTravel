<?php require __DIR__ . '/../../parts/connect_athome_db.php';
$pageName = 'stays_insert';
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
                            <label for="hotel_categories" class="form-label">飯店名稱</label>
                            <br>
                            <select name="hotel_categories" id=""></select>
                        </div>
                        <div class="mb-3">
                            <label for="city_name" class="form-label">縣市名稱</label>
                            <br>
                            <select name="city_name" id=""></select>
                        </div>
                        <div class="mb-3">
                            <label for="area_name" class="form-label">地區名稱</label>
                            <br>
                            <select name="area_name" id=""></select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">飯店名稱</label>
                            <input type="select" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">飯店代碼</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="mobile" class="form-label">飯店電話</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" pattern="09\d{2}?\d{3}?\d{3}">
                        </div>
                        <div class="mb-3">
                            <label for="birthday" class="form-label">飯店地址</label>
                            <input type="text" class="form-control" id="birthday" name="birthday">
                        </div>
                        <div class="mb-3">
                            <label for="birthday" class="form-label">飯店圖片</label>
                            <input type="file" class="form-control" id="birthday" name="birthday">
                        </div>
                        <div class="mb-3">
                            <label for="birthday" class="form-label">wifi</label>
                            <input type="checkbox" class="form-control" id="birthday" name="birthday">
                            <label for="birthday" class="form-label">早餐</label>
                            <input type="checkbox" class="form-control" id="birthday" name="birthday">
                            <label for="birthday" class="form-label">午餐</label>
                            <input type="checkbox" class="form-control" id="birthday" name="birthday">
                            <label for="birthday" class="form-label">晚餐</label>
                            <input type="checkbox" class="form-control" id="birthday" name="birthday">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">入住時間</label>
                            <input type="time">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">退房時間</label>
                            <input type="time">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">特殊設施</label>
                            <br>
                            <textarea name="" id="" cols="30" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">飯店描述</label>
                            <br>
                            <textarea name="" id="" cols="30" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    function checkForm() {

        let fd = new FormData(document.form1);
        for (let k of fd.keys()) {
            console.log(`${k}:${fd.get(k)}`);
        }

        fetch('insert-api.php', {
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
                    location.href = 'basepagewithdel&edit.php';
                }
            })


    }
</script>
<?php include __DIR__ . '/../../parts/script.php'; ?>
<?php include __DIR__ . '/../../parts/html-foot.php'; ?>