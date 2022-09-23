<?php
require __DIR__ . '/../parts/connect_db.php';
// require __DIR__ . '/../parts/connect_athome_db.php';
$pageName = 'login';
?>
<?php include __DIR__ . '/../parts/html-head.php'; ?>
<?php include __DIR__ . '/../parts/navbar.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-lg-6 mx-auto my-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">登入</h5>

                    <form name="loginForm" onsubmit="checkForm(); return false; ">
                    <div class="my-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="example@mail.com" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                    <div class="invalid-feedback">
                    請輸入正確的email格式
                    </div>
                    <div class="valid-feedback">
                    輸入正確
                    </div>
                    </div>
                        <div class="my-3">
                            <label for="password">密碼</label>
                            <input type="password" class="form-control" id="password" placeholder="請輸入8個字元以上的英文大小寫字母、數字" pattern="^(?=.*[a-zA-Z])(?=.*[0-9]).{8,}$" name="password_hash" required="required" oninput="setCustomValidity('');" oninvalid="setCustomValidity('請輸入8個字元以上的英文大小寫字母、數字');" required />
                                <!-- <div class="valid" id="passwordStatus">
                                請輸入8個字元以上的英文大小寫字母、數字
                                </div> -->
                        </div>
                        <button type="submit" class="btn btn-primary">登入</button>
                    </form>

                </div>
            </div>

        </div>
    </div>


</div>
<?php include __DIR__ . '/../parts/script.php'; ?>
<script>
    function checkForm() {

        const fd = new FormData(document.loginForm);

        fetch('login-api-admin.php', {
                method: 'POST',
                body: fd,
            })
            .then(r => r.json())
            .then(obj => {
                console.log(obj);
                if (obj.success) {
                    location.href = 'basepage.php';
                } else {
                    alert(obj.error);
                }
            })
    }
</script>

<?php include __DIR__ . '/../parts/html-foot.php'; ?>