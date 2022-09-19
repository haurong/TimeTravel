<?php session_start(); ?>
<?php include __DIR__ . '/../parts/html-head.php'; ?>
<?php include __DIR__ . '/../parts/navbar.php'; ?>

<form class="needs-validation col-6 mx-auto" name="signinForm" method="post" action="register.php" onsubmit="return validateForm()" novalidate>
  <h4 class="text-center">創建帳戶</h4>
  <div class="my-3">
    <label for="name">姓名</label>
    <input type="text" class="form-control" id="name" placeholder="name" required>
    <div class="invalid-feedback">
      請輸入正確姓名
    </div>
    <div class="valid-feedback">
      輸入正確
    </div>
  </div>
  <div class="my-3">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" placeholder="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
    <div class="invalid-feedback">
      請輸入正確的email格式
    </div>
    <div class="valid-feedback">
      輸入正確
    </div>
  </div>
  <div class="my-3">
    <label for="password">密碼</label>
    <input type="password" class="form-control" id="password" placeholder="password" required>
    <div class="valid" id="passwordStatus">
      請輸入8個字元以上的英文大小寫字母、數字和符號
    </div>
  </div>
  <div class="my-3">
    <label for="password_check">再次輸入密碼</label>
    <input type="password" class="form-control" id="password_check" placeholder="password_check" required>
    <div class="valid" id="passwordCheckStatus">
    </div>
  </div>

  <button class="btn btn-primary" type="submit">註冊</button>
</form>

<script>
  let passwordStatus = document.querySelector('#passwordStatus');
  let passwordCheckStatus = document.querySelector('#passwordCheckStatus');
  let password = document.forms["signinForm"]["password"].value;

  function passwordValidate() {

    let re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&]).{8,}$/g;


    if (re.test(password) === true) {
      passwordStatus.innerHTML = "輸入正確";
      console.log("輸入正確");
      return true;
    } else if (re.test(password) !== true) {
      passwordStatus.innerHTML = "密碼格式錯誤";
      console.log("密碼格式錯誤");
      return false;
    }
  }
  let password_check = document.querySelector('#password_check');
  password_check.addEventListener('keydown',
    function passwordCheckValidate() {
      let password_check_value = document.forms["signinForm"]["password_check"].value;

      if (password !== password_check) {
        passwordCheckStatus.innerHTML = "請輸入相同的密碼";
        console.log("請輸入相同的密碼");
        return false;
      } else if (password === password_check_value) {
        // alert("請輸入相同的密碼");
        passwordCheckStatus.innerHTML = "輸入正確";
        console.log("輸入正確");
        return false;
      }
    }
  )

  function validateForm() {
    if (passwordValidate() === false) {
      event.preventDefault();
      event.stopPropagation();
    }


  }
  // (function() {
  //   'use strict';
  //   window.addEventListener('load', function() {
  //     var forms = document.getElementsByClassName('needs-validation');
  //     var validation = Array.prototype.filter.call(forms, function(form) {
  //       form.addEventListener('submit', function(event) {
  //         if (form.checkValidity() === false) {
  //           event.preventDefault();
  //           event.stopPropagation();
  //         }
  //         form.classList.add('was-validated');
  //       }, false);
  //     });
  //   }, false);
  // })();
</script>

<?php include __DIR__ . '/../parts/script.php'; ?>
<?php include __DIR__ . '/../parts/html-foot.php'; ?>