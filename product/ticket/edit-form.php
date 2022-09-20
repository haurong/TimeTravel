<?php 
// require __DIR__ . '/parts/admin-required.php';
require __DIR__ . '/../../parts/connect_db.php';
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
                            <input type="text" class="form-control" id="product_number" name="product_number" required value="<?=  htmlentities($r['product_number']) ?>">
                        </div>

                        <div class="mb-3">
                            <label for="product_name" class="form-label">票券名稱</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" value="<?= $r['product_name'] ?>">
                        </div>

                        <div class="mb-3">
                            <label for="product_price" class="form-label">價格</label>
                            <input type="text" class="form-control" id="product_price" name="product_price" 
                             value="<?= $r['product_price'] ?>">
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
                            <input type="text" class="form-control" id="product_cover" name="product_cover" value="<?= $r['product_cover'] ?>">
                        </div>

                        <div class="mb-3">
                            <label for="product_imgs" class="form-label">介紹圖片</label>
                            <input type="text" class="form-control" id="product_imgs" name="product_imgs" value="<?= $r['product_imgs'] ?>">
                        </div>

                        <div class="mb-3">
                            <label for="categories_id" class="form-label">類別</label>
                            <input type="text" class="form-control" id="categories_id" name="categories_id" value="<?= $r['categories_id'] ?>">
                        </div>

                        <div class="mb-3">
                            <label for="cities_id" class="form-label">縣市地區</label>
                            <input type="text" class="form-control" id="cities_id" name="cities_id" value="<?= $r['cities_id'] ?>">
                        </div>

                        <div class="mb-3">
                            <label for="on_sale" class="form-label">狀態</label>
                            <input type="text" class="form-control" id="on_sale" name="on_sale" value="<?= $r['on_sale'] ?>">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>

<?php include __DIR__ . '/../../parts/script.php'; ?>
<script>
    function checkForm() {

        const fd = new FormData(document.form1);

        for (let k of fd.keys()) {
            console.log(`${k}: ${fd.get(k)}`);
        }

        fetch('edit-api.php', {
            method: 'POST',
            body: fd
        }).then(r => r.json()).then(obj => {
            console.log(obj);
            if (!obj.success) {
                alert(obj.error);
            } else {
                alert('修改成功');
                //location.href = 'list.php'; 
                //改完回列表↑
            }
        });
    }
</script>
<?php include __DIR__ . '/../../parts/html-foot.php'; ?>