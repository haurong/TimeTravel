<?php
if (!isset($_SESSION)) {
    session_start();
}
$food = $_SESSION['food-cart'];
$ticket = $_SESSION['ticket-cart'];
$foodqty = 0;
foreach ($food as $index => $item) {
    $foodqty += $item['qty'];
}

$ticketqty = 0;
foreach ($ticket as $index => $item) {
    $ticketqty += $item['qty'];
}
$qty = $foodqty + $ticketqty;
?>
<div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <?php if (empty($_SESSION['admin'])) : ?>
                <a class="navbar-brand <?= $pageName == 'index' ? 'active' : ''  ?>" href="/TimeTravel/index.php">TimeTravel</a>
            <?php else : ($_SESSION['admin']) ?>
                <a class="navbar-brand <?= $pageName == 'base' ? 'active' : ''  ?>" href="/TimeTravel/member/basepage.php">TimeTravel</a>
            <?php endif; ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <?php if (empty($_SESSION['admin'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $pageName == '' ? 'disabled' : '' ?>" href="">會員資料列表</a>
                        </li>
                    <?php else : ($_SESSION['admin']) ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $pageName == 'member-list' ? 'disabled' : '' ?>" href="/TimeTravel/member/member-list.php">會員資料列表</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/TimeTravel/cart/cart-list.php">購物車
                            <?php
                            if (isset($_SESSION['food-cart']) || isset($_SESSION['hotel-cart']) || isset($_SESSION['ticket-cart'])) {
                                $count = $qty  + count($_SESSION['hotel-cart']);
                                echo "<span class=\"badge badge-pill badge-info cart-count\">$count</span>";
                            } else {
                                echo "<span class=\"badge badge-pill badge-info cart-count\">0</span>";
                            }
                            ?>
                        </a>

                    </li>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0 ml-auto">
                    <?php if (empty($_SESSION['admin'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $pageName == 'login' ? 'active' : '' ?>" href="/TimeTravel/member/login-form.php">登入</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/TimeTravel/member/signin-form.php">註冊</a>
                        </li>
                    <?php else : ?>

                        <li class="nav-item">
                            <a class="nav-link " id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $_SESSION['admin']['email'] ?></a>
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