<?php require __DIR__ . '/../parts/connect_db.php' ?>
<?php include __DIR__ . '/../parts/html-head.php'; ?>
<?php include __DIR__ . '/../parts/navbar.php'; ?>
<?php $food = $_SESSION['food-cart']; ?>

<div class="container">
    <h3 class="text-center">購物車</h3>
</div>
<div class="container">
    <div class="row">

        <table class="table">
            <thead>
                <h3>美食</h3>
                <tr>
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
                        <td><?= $val['product_name'] ?></td>
                        <td><?= $val['product_photo'] ?></td>
                        <td><?= $val['p_selling_price'] ?></td>
                        <td><?= $val['applicable_store'] ?></td>
                        <td><p><?= $val['qty'] ?></p></td>
                        <td><?= $val['p_selling_price'] * $val['qty']; ?></td>
                    <?php } ?>
                    </tr>
            </tbody>
        </table>
        </form>

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
</script>
<?php include __DIR__ . '/../parts/html-foot.php'; ?>