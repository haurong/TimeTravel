<?php
    if(! isset($_SESSION)){
        session_start();
    }
?>
<div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand"  href="/TimeTravel/index.php">TimeTravel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <?php if (empty($_SESSION['admin'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $pageName=='' ? 'disabled' : '' ?>"  href="">會員資料列表</a>
                    </li>
                    <?php else : ($_SESSION['admin']) ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $pageName=='member-list' ? 'disabled' : '' ?>"  href="/TimeTravel/member/member-list.php">會員資料列表</a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/TimeTravel/cart/cart-list.php">購物車
                            <span class="badge badge-pill badge-info cart-count"></span></a>
                    </li>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0 ml-auto">
                    <?php if (empty($_SESSION['admin'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $pageName=='login' ? 'active' : '' ?>" href="/TimeTravel/member/login-form.php">登入</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/TimeTravel/member/signin-form.php">註冊</a>
                        </li>
                    <?php else : ?>
                    
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle " id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $_SESSION['admin']['email'] ?></a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/TimeTravel/member/password.php">重設密碼</a>
                        </div>
                            <!-- <a class="nav-link"></a>
                            <a class="nav-link">重設密碼</a> -->
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