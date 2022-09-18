<?php session_start(); ?>
<?php include __DIR__ . '/../parts/html-head.php'; ?>
<?php include __DIR__ . '/../parts/navbar.php'; ?>

<div class="container">
    <form>
        <h4 class="text-center">創建帳戶</h4>
        <div class="col-4 my-3 mx-auto">
            <label for="validationServer01">姓名</label>
            <input type="text" class="form-control is-valid" id="validationServer01" placeholder="例如：小明" value="" required>
            <div class="valid-feedback">
                輸入正確
            </div>
        </div>
        <div class="col-4 my-3 mx-auto">
            <label for="validationServer03">email</label>
            <input type="text" class="form-control is-invalid" id="validationServer03" placeholder="email" required>
            <div class="invalid-feedback">
                請輸入
            </div>
        </div>
        <div class="col-4 my-3 mx-auto">
            <label for="validationServer04">State</label>
            <input type="text" class="form-control is-invalid" id="validationServer04" placeholder="State" required>
            <div class="invalid-feedback">
                Please provide a valid state.
            </div>
        </div>
        <div class="col-4 my-3 mx-auto">
            <label for="validationServer05">Zip</label>
            <input type="text" class="form-control is-invalid" id="validationServer05" placeholder="Zip" required>
            <div class="invalid-feedback">
                Please provide a valid zip.
            </div>
        </div>
        <button class="btn btn-primary mx-auto" type="submit">Submit form</button>
    </form>
</div>

<?php include __DIR__ . '/../parts/html-foot.php'; ?>