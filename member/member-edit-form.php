<?php 
//連結權限頁
require __DIR__ . '/../parts/connect_db.php';
$pageName = 'member-edit';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

if(empty($sid)){
    header('Location: member-list.php');
    exit;
}

$sql = "SELECT * FROM member_information WHERE sid=$sid";
$r = $pdo->query($sql)->fetch();
if(empty($r)){
    header('Location: member-list.php');
    exit;
}



?>
<?php require __DIR__ . '/../parts/html-head.php'; ?>
<?php include __DIR__ . '/../parts/navbar.php'; ?>
<form class="needs-validation col-6 mx-auto" name="memberEditForm" action="" onsubmit="checkForm();return false;" novalidate>
  <h4 class="text-center">修改會員資料</h4>
  <div class="my-3">
    <label for="username">姓名</label>
    <input type="text" class="form-control" id="username" placeholder="username" name="username">
    <div class="invalid-feedback">
      請輸入正確姓名
    </div>
    <div class="valid-feedback">
      輸入正確
    </div>
  </div>
  <div class="my-3">
    <label for="telephone">手機號碼</label>
    <input type="text" class="form-control" id="telephone" placeholder="telephone" name="telephone">
    <div class="invalid-feedback">
      請輸入正確姓名
    </div>
    <div class="valid-feedback">
      輸入正確
    </div>
  </div>

  <button class="btn btn-primary" type="submit">確定</button>
</form>
<?php include __DIR__ . '/../parts/script.php'; ?>
<script>
    function checkForm(){
        // document.form1.email.value
        const fd = new FormData(document.memberEditForm);

        for(let k of fd.keys()){
            console.log(`${k}: ${fd.get(k)}`);
        };
        // TODO: 檢查欄位資料

        fetch('member-edit-api.php', {
            method: 'POST',
            body: fd
        }).then(r=>r.json()).then(obj=>{
            console.log(obj);
            if(! obj.success){
                alert(obj.error);
            } else {
                alert('修改成功')
                 location.href = 'member-list.php';
            }
        });
    }
</script>
<?php include __DIR__ . '/../parts/html-foot.php'; ?>