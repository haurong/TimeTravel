<?php require __DIR__ . '/../parts/connect_db.php' ?>
<?php include __DIR__ . '/../parts/html-head.php'; ?>
<?php include __DIR__ . '/../parts/navbar.php'; ?>
<?php
if (!isset($_SESSION['food-cart'])) {
    $_SESSION['food-cart'] = [];
}
if (!isset($_SESSION['hotel-cart'])) {
    $_SESSION['hotel-cart'] = [];
}
if (!isset($_SESSION['ticket-cart'])) {
    $_SESSION['ticket-cart'] = [];
}

?>
<?php $food = $_SESSION['food-cart']; ?>
<?php $hotel = $_SESSION['hotel-cart'] ?>
<?php $ticket = $_SESSION['ticket-cart'] ?>

<div class="container">
    <h3 class="text-center">購物車</h3>
</div>
<div class="container">
    <div class="row">
        <table class="table">
            <thead>
                <h3>美食</h3>
                <tr>
                    <th scope="col">
                        <i class="fa-solid fa-trash-can"></i>
                    </th>
                    <th scope="col">商品名稱</th>
                    <th scope="col">商品圖片</th>
                    <th scope="col">適用商家</th>
                    <th scope="col">單價</th>
                    <th scope="col">數量</th>
                    <th scope="col">總價</th>

                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($food as $k => $val) { ?>
                    <tr>
                        <td>
                            <a href="javascript: removefood(<?= $val['sid'] ?>)">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </td>
                        <td><?= $val['product_name'] ?></td>
                        <td><?= $val['product_photo'] ?></td>
                        <td><?= $val['p_selling_price'] ?></td>
                        <td><?= $val['applicable_store'] ?></td>
                        <td>
                            <p><?= $val['qty'] ?></p>
                        </td>
                        <td><?= $val['p_selling_price'] * $val['qty']; ?></td>
                    <?php } ?>
                    </tr>
            </tbody>
        </table>
        <table class="table">
            <thead>
                <h3>住宿</h3>
                <tr>
                    <th scope="col">
                        <i class="fa-solid fa-trash-can"></i>
                    </th>
                    <th scope="col">飯店名稱</th>
                    <th scope="col">飯店圖片</th>
                    <th scope="col">飯店地址</th>

                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($hotel as $k => $val) { ?>
                    <tr>
                        <td>
                            <a href="javascript: delete_it(<?= $r['sid'] ?>)">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </td>
                        <td><?= $val['hotel_name'] ?></td>
                        <td><?= $val['picture'] ?></td>
                        <td><?= $val['address'] ?></td>
                    <?php } ?>
                    </tr>
            </tbody>
        </table>
        <table class="table">
            <thead>
                <h3>票券</h3>
                <tr>
                    <th scope="col">
                        <i class="fa-solid fa-trash-can"></i>
                    </th>
                    <th scope="col">商品名稱</th>
                    <th scope="col">商品圖片</th>
                    <th scope="col">介紹</th>
                    <th scope="col">單價</th>
                    <th scope="col">數量</th>
                    <th scope="col">總價</th>

                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($ticket as $k => $val) { ?>
                    <tr>
                        <td>
                            <a href="javascript: delete_it(<?= $r['sid'] ?>)">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </td>
                        <td><?= $val['product_name'] ?></td>
                        <td><?= $val['product_imgs'] ?></td>
                        <td><?= $val['product_introduction'] ?></td>
                        <td><?= $val['product_price'] ?></td>
                        <td>
                            <p><?= $val['qty'] ?></p>
                        </td>
                        <td><?= $val['product_price'] * $val['qty']; ?></td>
                    <?php } ?>
                    </tr>
            </tbody>
        </table>

    </div>
</div>
<?php include __DIR__ . '/../parts/script.php'; ?>
<script>
    // function changeqty(event) {
    //       fetch('put-in-cart.php',{
    //         method: "POST",
    //         body: JSON.stringify(qty = <?= $val['qty']; ?>)
    //       }).then(r=>r.json())
    //       .then(obj=>{
    //         console.log(obj);
    //       })
    // console.log(newqty);
    // console.log(tr);
    // }
    function removefood(sid){
        location.href = `removefood.php?sid=${sid}`;
    }
</script>
<?php include __DIR__ . '/../parts/html-foot.php'; ?>