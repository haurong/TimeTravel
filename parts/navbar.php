<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/TimeTravel/index.php">TimeTravel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/TimeTravel/product/product-list.php">商品列表</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/TimeTravel/cart/cart-list.php">購物車
                            <span class="badge badge-pill badge-info cart-count"></span></a>
                    </li>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0 ml-auto">
                    <?php if (empty($_SESSION['user1'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/TimeTravel/member/login-form.php">登入</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/TimeTravel/member/signin-form.php">註冊</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link"><?= $_SESSION['user1']['nickname'] ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/TimeTravel/member/logout.php">登出</a>
                        </li>
                    <?php endif; ?>



                </ul>

            </div>
        </div>
    </nav>
</div>