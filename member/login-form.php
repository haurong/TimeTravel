<?php
// require __DIR__ . '/../parts/connect_db.php';
require __DIR__ . '/../parts/connect_athome_db.php';
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

                    <form name="loginForm" onsubmit="checkForm(); return false;">
                        <div class="mb-3">
                            <label for="email" class="form-label">帳號</label>
                            <input type="text" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">密碼</label>
                            <input type="password" class="form-control" id="password" name="password">
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