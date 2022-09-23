<?php 
//連結權限頁
//require __DIR__ . '/../../parts/connect_athome_db.php'; 
require __DIR__ . '/../../parts/connect_db.php';
$pageName = 'food-edit';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

if(empty($sid)){
    header('Location: food-list.php');
    exit;
}

$sql = "SELECT * FROM food_product_all WHERE sid=$sid";
$r = $pdo->query($sql)->fetch();
if(empty($r)){
    header('Location: food-list.php');
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
                    <form name="form1" onsubmit="checkForm(); return false;" novalidate>
                        <input type="hidden" name="sid" value="<?= $r['sid'] ?>">
                    <!--產品編號-->
                        <div class="mb-3">
                            <label for="product_number" class="form-label">產品編號</label>
                            <input type="text" class="form-control" id="product_number" name="product_number" required value="<?= ($r['product_number']) ?>">
                        </div>
                    <!--產品名稱-->
                        <div class="mb-3">
                            <label for="product_name" class="form-label">產品名稱</label>
                            <input type="text" class="form-control" id="product_name" name="product_name"  value="<?= $r['product_name'] ?>">
                        </div>
                    <!--產品實際售價-->
                        <div class="mb-3">
                            <label for="p_selling_price" class="form-label">產品實際售價</label>
                            <input type="text" class="form-control" id="p_selling_price" name="p_selling_price"  value="<?= $r['p_selling_price'] ?>">
                        </div>
                    <!--產品面額-->
                        <div class="mb-3">
                            <label for="p_discounted_price" class="form-label">產品面額</label>
                            <input type="text" class="form-control" id="p_discounted_price" name="p_discounted_price"  value="<?= $r['p_discounted_price'] ?>" >
                        </div>
                    <!--產品照片-->
                        <div class="mb-3">
                            <label for="product_photo" class="form-label">產品照片</label>
                            <input type="text" class="form-control" id="product_photo" name="product_photo"  value="<?= $r['product_photo'] ?>" >
                            <button type="button" class="btn btn-outline-info mt-3" id="product_photobtn" onclick="realpicture.click()">上傳圖片</button>
                        </div>
                    <!--適用店家-->
                        <div class="mb-3">
                            <label for="applicable_store" class="form-label">適用商家</label>
                            <input type="text" class="form-control" id="applicable_store" name="applicable_store"  value="<?= $r['applicable_store'] ?>" >
                        </div>
                    <!--產品敘述-->
                        <div class="mb-3">
                            <label for="product_introdution" class="form-label">產品描述</label>
                            <input type="text" class="form-control" id="product_introdution" name="product_introdution"  value="<?= $r['product_introdution'] ?>" >
                        </div>
                    <!--商家營業時間-->
                        <div class="mb-3">
                            <label for="p_business_hours" class="form-label">商家營業時間</label>
                            <input type="text" class="form-control" id="p_business_hours" name="p_business_hours"  value="<?= $r['p_business_hours'] ?>" >
                        </div>
                    <!--商家地址-->
                        <div class="mb-3">
                            <label for="product_address" class="form-label">商家地址</label>
                            <input type="text" class="form-control" id="product_address" name="product_address"  value="<?= $r['product_address'] ?>" >
                        </div>
                    <!--上架狀態-->
                    <div class="mb-3">
                        <label for="listing_status_sid" >上架狀態</label>
                            <br>
                            <input type="radio"  id="listing_status_sid1" name="listing_status_sid" value="1">
                            <label for="">上架</label>
                            <input type="radio"  id="listing_status_sid2" name="listing_status_sid" value="2">
                            <label for="">下架</label>
                        </div>
                    <!--分類-->
                    <div class="mb-3">
                            <label for="categories_sid" class="form-label mt-2 mb-2">分類</label>
                            <br>
                            <input type="radio" id="categories_sid1" name="categories_sid" value="1">
                            <label for="categories_sid" class="form-label">特色小吃</label>
                            <input type="radio" id="categories_sid2" name="categories_sid"value="2" >
                            <label for="categories_sid" class="form-label">台式料理</label>
                            <input type="radio" id="categories_sid3" name="categories_sid"value="3" >
                            <label for="categories_sid" class="form-label">泰式料理</label>
                            <input type="radio" id="categories_sid4" name="categories_sid"value="4" >
                            <label for="categories_sid" class="form-label">日式料理</label>
                            <br>
                            <input type="radio" id="categories_sid5" name="categories_sid"value="5" >
                            <label for="categories_sid" class="form-label">火鍋</label>
                            <input type="radio" id="categories_sid6" name="categories_sid"value="6" >
                            <label for="categories_sid" class="form-label">飲品</label>
                            <input type="radio" id="categories_sid7" name="categories_sid"value="7" >
                            <label for="categories_sid" class="form-label">甜點</label>
                            <input type="radio" id="categories_sid8" name="categories_sid" value="8" >
                            <label for="categories_sid" class="form-label">咖啡</label>
                        </div>
                   <!--縣市--> 
                   <div class="mb-3">
                            <label for="city_sid" class="form-label">縣市</label>
                            <br>
                            <input type="radio" id="city_sid1" name="city_sid"  value="1">
                            <label for="city_sid" class="form-label">台北市</label>
                            <input type="radio" id="city_sid2" name="city_sid"  value="2">
                            <label for="city_sid" class="form-label">新北市</label>
                            <input type="radio"id="city_sid3" name="city_sid"  value="3">
                            <label for="city_sid" class="form-label">基隆市</label>
                            <input type="radio"id="city_sid4" name="city_sid"  value="4">
                            <label for="city_sid" class="form-label">雙北地區</label>
                            <input type="radio" id="city_sid5" name="city_sid"  value="5">
                            <label for="city_sid" class="form-label">北北基</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <form action="" name="form_for_picture" style="display: none;">
                            <input type="file" name="realpicture" id="realpicture" accept="image/png , image/jpeg" style="display: none;">
                    </form> 
                </div>
            </div>

        </div>
    </div>
</div>
<?php include __DIR__ . '/../../parts/script.php'; ?>
<script>

let product_photo = document.getElementById('product_photo')
let realpicture = document.getElementById('realpicture')
    let listing_status_sid1 = document.getElementById('listing_status_sid1');
    let listing_status_sid2 = document.getElementById('listing_status_sid2');


    let city_sid1 = document.getElementById('city_sid1');
    let city_sid2 = document.getElementById('city_sid2');
    let city_sid3 = document.getElementById('city_sid3');
    let city_sid4 = document.getElementById('city_sid4');
    let city_sid5 = document.getElementById('city_sid5');

    let categories_sid1 = document.getElementById('categories_sid1');
    let categories_sid2 = document.getElementById('categories_sid2');
    let categories_sid3 = document.getElementById('categories_sid3');
    let categories_sid4 = document.getElementById('categories_sid4');
    let categories_sid5 = document.getElementById('categories_sid5');
    let categories_sid6 = document.getElementById('categories_sid6');
    let categories_sid7 = document.getElementById('categories_sid7');
    let categories_sid8 = document.getElementById('categories_sid8');



   if("<?= $r['city_sid'] ?>" === "1"){
        city_sid1.checked=true;
   }else if("<?= $r['city_sid'] ?>" === "2"){
        city_sid2.checked=true;
   }else if("<?= $r['city_sid'] ?>" === "3"){
        city_sid3.checked=true;
   }else if("<?= $r['city_sid'] ?>" === "4"){
        city_sid4.checked=true;
   }else if("<?= $r['city_sid'] ?>" === "5"){
        city_sid5.checked=true;
   };
  
   if("<?=$r['categories_sid']?>" === "1"){
        categories_sid1.checked=true;
   }else if("<?=$r['categories_sid']?>" === "2"){
        categories_sid2.checked=true;
   }
   else if("<?=$r['categories_sid']?>" === "3"){
        categories_sid3.checked=true;
   }
   else if("<?=$r['categories_sid']?>" === "4"){
        categories_sid4.checked=true;
   }
   else if("<?=$r['categories_sid']?>" === "5"){
        categories_sid5.checked=true;
   }
   else if("<?=$r['categories_sid']?>" === "6"){
        categories_sid6.checked=true;
   }
   else if("<?=$r['categories_sid']?>" === "7"){
        categories_sid7.checked=true;
   }
   else if("<?=$r['categories_sid']?>" === "8"){
        categories_sid8.checked=true;
   }
   
   if("<?=$r['listing_status_sid']?>" === "1"){
        listing_status_sid1.checked = true;
   }else if("<?=$r['listing_status_sid']?>" === "2"){
        listing_status_sid2.checked = true;
   }
   
   
   
   
   
   function checkForm(){
        // document.form1.email.value
        const fd = new FormData(document.form1);

        for(let k of fd.keys()){
            console.log(`${k}: ${fd.get(k)}`);
        };
        // TODO: 檢查欄位資料

        fetch('food-edit-api.php', {
            method: 'POST',
            body: fd
        }).then(r=>r.json()).then(obj=>{
            console.log(obj);
            if(! obj.success){
                alert(obj.error);
            } else {
                alert('更改成功')
                 location.href = 'food-list.php';
            }
        });
    }
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
            // console.log(fdfp_obj.filename);
            product_photo.value = fdfp_obj.filename
        })
    })
</script>
<?php include __DIR__ . '/../../parts/html-foot.php'; ?>