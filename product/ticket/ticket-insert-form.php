<?php
// require __DIR__ . '/parts/admin-required.php';
require __DIR__ . '/../../parts/connect_db.php';
$pageName = 'insert';
?>

<?php require __DIR__ . '/../../parts/html-head.php'; ?>
<?php include __DIR__ . '/../../parts/navbar.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">

                <div class="card-body">
                    <h5 class="card-title">新增資料</h5>
                    <form name="form1" onsubmit="checkForm(); return false;">
                                        
                        <div class="mb-3">
                            <label for="product_number" class="form-label">票券代號</label>
                            <input type="text" class="form-control" id="product_number" name="product_number" required>
                        </div>

                        <div class="mb-3">
                            <label for="product_name" class="form-label">票券名稱</label>
                            <input type="text" class="form-control" id="product_name" name="product_name">
                        </div>

                        <div class="mb-3">
                            <label for="product_price" class="form-label">價格</label>
                            <input type="text" class="form-control" id="product_price" name="product_price">
                        </div>

                        <div class="mb-3">
                            <label for="product_introduction" class="form-label">介紹</label>
                            <textarea class="form-control" name="product_introduction" id="product_introduction" cols="50" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="product_notice" class="form-label">注意說明</label>
                            <textarea class="form-control" name="product_notice" id="product_notice" cols="50" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="start_day" class="form-label">開始日</label>
                            <input type="date" class="form-control" id="start_day" name="start_day">
                        </div>

                        <div class="mb-3">
                            <label for="end_day" class="form-label">結束日</label>
                            <input type="date" class="form-control" id="end_day" name="end_day">
                        </div>

                        <div class="mb-3">
                            <label for="product_cover" class="form-label">封面圖片</label>
                            <input type="text" class="form-control" id="product_cover" name="product_cover">
                        </div>

                        <div class="mb-3">
                            <label for="product_imgs" class="form-label">介紹圖片</label>
                            <input type="text" class="form-control" id="product_imgs" name="product_imgs">
                        </div>

                        <div class="mb-3">
                            <label for="categories_id" class="form-label">類別</label>
                            <input type="text" class="form-control" id="categories_id" name="categories_id">
                        </div>

                        <div class="mb-3">
                            <label for="cities_id" class="form-label">縣市地區</label>
                            <input type="text" class="form-control" id="cities_id" name="cities_id">
                        </div>

                        <div class="mb-3">
                            <label for="on_sale" class="form-label">狀態</label>
                            <input type="text" class="form-control" id="on_sale" name="on_sale">
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

            const fd = new FormData(document.form1);

            for (let k of fd.keys()) {
                console.log(`${k}: ${fd.get(k)}`);
            }

            fetch('ticket-insert-api.php', {
                method: 'POST',
                body: fd
            }).then(r => r.json()).then(obj => {
                console.log(obj);
                if(!obj.success){
                    alert(obj.error);
                }else{
                    alert('新增成功');
                    location.href = 'ticket.php';
                }
            })
        }
</script>
<?php include __DIR__ . '/../../parts/script.php'; ?>
<?php include __DIR__ . '/../../parts/html-foot.php'; ?>