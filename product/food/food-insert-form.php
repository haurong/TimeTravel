<?php 
//連結權限頁
//require __DIR__ . '/../../parts/connect_athome_db.php'; 
require __DIR__ . '/../../parts/connect_db.php';
$pageName = 'food-insert';


?>
<?php require __DIR__ . '/../../parts/html-head.php'; ?>
<?php include __DIR__ . '/../../parts/navbar.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">新增資料</h5>
                    <form action"" name="form1" onsubmit="checkForm(); return false;" novalidate>
                      
                    <!--產品編號-->
                        <div class="mb-3">
                            <label for="product_number" class="form-label">產品編號</label>
                            <input type="text" class="form-control" id="product_number" name="product_number" placeholder="ex:F000" required >
                        </div>
                    <!--產品名稱-->
                        <div class="mb-3">
                            <label for="product_name" class="form-label">產品名稱</label>
                            <input type="text" class="form-control" id="product_name" name="product_name">
                        </div>
                    <!--產品實際售價-->
                        <div class="mb-3">
                            <label for="p_selling_price" class="form-label">產品實際售價</label>
                            <input type="text" class="form-control" id="p_selling_price" name="p_selling_price"  >
                        </div>
                    <!--產品面額-->
                        <div class="mb-3">
                            <label for="p_discounted_price" class="form-label">產品面額</label>
                            <input type="text" class="form-control" id="p_discounted_price" name="p_discounted_price" >
                        </div>
                    <!--產品照片-->
                        <div class="mb-3">
                            <label for="product_photo" class="form-label">產品照片</label>
                            <input type="text" class="form-control" id="product_photo" name="product_photo">
                        </div>
                    <!--適用店家-->
                        <div class="mb-3">
                            <label for="applicable_store" class="form-label">適用商家</label>
                            <input type="text" class="form-control" id="applicable_store" name="applicable_store" >
                        </div>
                    <!--產品敘述-->
                        <div class="mb-3">
                            <label for="product_introdution" class="form-label">產品描述</label>
                            <input type="text" class="form-control" id="product_introdution" name="product_introdution" >
                        </div>
                    <!--商家營業時間-->
                        <div class="mb-3">
                            <label for="p_business_hours" class="form-label">商家營業時間</label>
                            <input type="text" class="form-control" id="p_business_hours" name="p_business_hours" placeholder="1100-2100">
                        </div>
                    <!--商家地址-->
                        <!-- <div class="mb-3">
                            <label for="product_address" class="form-label">商家地址</label>
                            <input type="text" class="form-control" id="product_address" name="product_address"  >
                        </div> -->
                    <!--上架狀態-->
                        <div class="mb-3">
                            <label for="listing_status_sid" >上架狀態</label>
                            <br>
                            <input type="radio"  id="listing_status_sid" name="listing_status_sid" value="1">
                            <label for="">上架</label>
                            <input type="radio"  id="listing_status_sid" name="listing_status_sid" value="2">
                            <label for="">下架</label>
                        </div>
                    <!--分類-->
                        <div class="mb-3">
                            <label for="categories_sid" class="form-label mt-2 mb-2">分類</label>
                            <br>
                            <input type="radio" id="categories_sid" name="categories_sid" value="1">
                            <label for="categories_sid" class="form-label">特色小吃</label>
                            <input type="radio" id="categories_sid" name="categories_sid"value="2" >
                            <label for="categories_sid" class="form-label">台式料理</label>
                            <input type="radio" id="categories_sid" name="categories_sid"value="3" >
                            <label for="categories_sid" class="form-label">泰式料理</label>
                            <input type="radio" id="categories_sid" name="categories_sid"value="4" >
                            <label for="categories_sid" class="form-label">日式料理</label>
                            <br>
                            <input type="radio" id="categories_sid" name="categories_sid"value="5" >
                            <label for="categories_sid" class="form-label">火鍋</label>
                            <input type="radio" id="categories_sid" name="categories_sid"value="6" >
                            <label for="categories_sid" class="form-label">飲品</label>
                            <input type="radio" id="categories_sid" name="categories_sid"value="7" >
                            <label for="categories_sid" class="form-label">甜點</label>
                            <input type="radio" id="categories_sid" name="categories_sid" value="8" >
                            <label for="categories_sid" class="form-label">咖啡</label>
                        </div>
                   <!--縣市--> 
                        <div class="mb-3">
                            <label for="city_sid" class="form-label">縣市</label>
                            <br>
                            <input type="radio" id="city_sid" name="city_sid" value="1">
                            <label for="city_sid" class="form-label">台北市</label>
                            <input type="radio" id="city_sid" name="city_sid" value="2">
                            <label for="city_sid" class="form-label">新北市</label>
                            <input type="radio"id="city_sid" name="city_sid" value="3">
                            <label for="city_sid" class="form-label">基隆市</label>
                            <input type="radio"id="city_sid" name="city_sid" value="4">
                            <label for="city_sid" class="form-label">雙北地區</label>
                            <input type="radio" id="city_sid" name="city_sid" value="5">
                            <label for="city_sid" class="form-label">北北基</label>
                        </div>     
                      <button type="submit" class="btn btn-primary">新增</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function checkForm(){
        // document.form1.email.value

        const fd = new FormData(document.form1);

        for(let k of fd.keys()){
            console.log(`${k}: ${fd.get(k)}`);
        };
        // TODO: 檢查欄位資料

        fetch('food-insert-api.php', {
            method: 'POST',
            body: fd
        }).then(r=>r.json())
        .then(obj=>{
            console.log(obj);
            if(! obj.success){
                alert(obj.error);
            } else {
                alert('新增成功')
                 location.href = 'food-list.php';
            }
        })
    }
</script>
<?php include __DIR__ . '/../../parts/script.php'; ?>
<?php include __DIR__ . '/../../parts/html-foot.php'; ?>