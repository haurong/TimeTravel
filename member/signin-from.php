<?php session_start(); ?>
<?php include __DIR__ . '/../parts/html-head.php'; ?>
<?php include __DIR__ . '/../parts/navbar.php'; ?>

<div class="container">
    <form>
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
            <input type="text" class="form-control is-invalid" id="validationServer05" placeholder="Zip" required>
            <div class="invalid-feedback">
                
            </div>
        </div>
        <button class="btn btn-primary mx-auto" type="submit">註冊</button>
    </form>
</div>

<?php include __DIR__ . '/../parts/html-foot.php'; ?>