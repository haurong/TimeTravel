<?php session_start(); ?>
<?php include __DIR__ . '/../parts/html-head.php'; ?>
<?php include __DIR__ . '/../parts/navbar.php'; ?>

<form class="needs-validation col-6 mx-auto" name="signinForm" action="" onsubmit="checkForm();return false;" validate>
  <h4 class="text-center">重設密碼</h4>
  <div class="my-3">
    <label for="password">舊密碼</label>
    <input type="password" class="form-control" id="old_password" placeholder="old_password" pattern="^(?=.*[a-zA-Z])(?=.*[0-9]).{8,}$" name="old_password" required="required" oninput="setCustomValidity('');" oninvalid="setCustomValidity('請輸入舊密碼');" required />
  </div>
  <div class="my-3">
    <label for="password">密碼</label>
    <input type="password" class="form-control" id="password" placeholder="password" pattern="^(?=.*[a-zA-Z])(?=.*[0-9]).{8,}$" name="password_hash" required="required" oninput="setCustomValidity('');" oninvalid="setCustomValidity('請輸入8個字元以上的英文大小寫字母、數字');" required />
    <div class="valid" id="passwordStatus">
      請輸入8個字元以上的英文大小寫字母、數字
    </div>
  </div>
  <div class="my-3">
    <label for="password_check">再次輸入密碼</label>
    <input type="password" class="form-control" id="password_check" placeholder="password_check" oninput="setCustomValidity('');" onchange="if(document.getElementById('password').value != document.getElementById('password_check').value){setCustomValidity('密碼不相同');}" required />
    <div class="valid" id="passwordCheckStatus">
    </div>
  </div>
  <div class="text-center">
    <button class="btn btn-primary " type="submit">確定</button>
  </div>
  
</form>
<?php include __DIR__ . '/../parts/script.php'; ?>
<script>
  function checkForm() {
    // document.form1.email.value

    const fd = new FormData(document.signinForm);

    for (let k of fd.keys()) {
      console.log(`${k}: ${fd.get(k)}`);
    }
    // TODO: 檢查欄位資料

    fetch('password-api.php', {
      method: 'POST',
      body: fd
    }).then(r => r.json()).then(obj => {
      console.log(obj);
      if (!obj.success) {
        alert(obj.error);
      } else {
        alert('重設密碼成功，請重新登入')
        location.href = '/../TimeTravel/index.php';
      }
    })
  }
</script>
<?php include __DIR__ . '/../parts/html-foot.php'; ?>