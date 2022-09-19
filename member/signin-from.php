<?php session_start(); ?>
<?php include __DIR__ . '/../parts/html-head.php'; ?>
<?php include __DIR__ . '/../parts/navbar.php'; ?>
<script>
        
        function validateForm() {
            let re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&]).{8,}$/g;
            let x = document.forms["signinForm"]["password"].value;
            let y = document.forms["signinForm"]["password_check"].value;
            if(x.length<6){
                alert("密碼長度不足");
                return false;
            }
            if (x != y) {
                alert("請確認密碼是否輸入正確");
                return false;
            }
        }
</script>
<div class="container">
    <form name="signinForm" method="post" action="register.php" onsubmit="return validateForm()">
        <h4 class="text-center">創建帳戶</h4>
        <div class="col-5 my-3 mx-auto">
            <label for="validationServer01">姓名</label>
            <input type="text" class="form-control is-valid" id="validationServer01" placeholder="name" value="" required>
            <div class="valid-feedback">
                輸入正確
            </div>
        </div>
        <div class="col-5 my-3 mx-auto">
            <label for="validationServer03">email</label>
            <input type="text" class="form-control is-invalid" id="validationServer03" placeholder="email" required>
            <div class="invalid-feedback">
                請輸入正確的電子郵件
            </div>
        </div>
        <div class="col-5 my-3 mx-auto">
            <label for="validationServer04">密碼</label>
            <input type="text" class="form-control is-invalid" id="validationServer04" placeholder="password" required>
            <div class="invalid-feedback">
                包含至少 8 个字符
            </div>
            <div class="invalid-feedback">
                包含小寫字母 (a-z) 和大寫字母 (A-Z)
            </div>
            <div class="invalid-feedback">
                至少包含一個數字 (0-9)
            </div>
        </div>
        <div class="col-5 my-3 mx-auto">
            <label for="validationServer05">再次輸入密碼</label>
            <input type="text" class="form-control is-invalid" id="validationServer05" placeholder="password" required>
            <div class="invalid-feedback">
                請輸入相同的密碼
            </div>
        </div>
        <div class="col-5 my-3 mx-auto">
            <label for="validationServer05">手機號碼</label>
            <input type="text" class="form-control" id="validationServer06" placeholder="password" required>
            <div class="invalid-feedback">
                （可不填）
            </div>
        </div>
        <div class="text-center py-3">
            <button class="btn btn-primary " type="submit">註冊</button>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../parts/html-foot.php'; ?>