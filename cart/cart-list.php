<?php require __DIR__ . '/../parts/connect_db.php' ?>
<?php include __DIR__ . '/../parts/html-head.php'; ?>
<?php include __DIR__ . '/../parts/navbar.php'; ?>
<?php $food = $_SESSION['food-cart']; ?>
<?php $hotel = $_SESSION['hotel-cart']; ?>
<?php $ticket = $_SESSION['ticket-cart']; ?>

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
            <form action="submit.php" method="post">
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
                            <td><img width=200 src="./../imgs/./food-img/<?= $val['product_photo'] ?>" alt=""></td>
                            <td><?= $val['applicable_store'] ?></td>
                            <td><?= $val['p_selling_price'] ?></td>
                            <td>
                                <p><?= $val['qty'] ?></p>
                            </td>
                            <td><?= $val['p_selling_price'] * $val['qty']; ?></td>
                            <td>
                                <input type="hidden" name="food_sid" value="<?= $val['sid'] ?>">
                                <input type="hidden" name="food_name" value="<?= $val['product_name'] ?>">
                                <input type="hidden" name="food_quantity" value="<?= $val['qty'] ?>">
                                <input type="hidden" name="food_total_price" value="<?= $val['p_selling_price'] * $val['qty']; ?>">
                            </td>

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
                            <a href="javascript: removehotel(<?= $val['sid'] ?>)">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </td>
                        <td><?= $val['hotel_name'] ?></td>
                        <td>
                            <img style="width:200px" src="/../TimeTravel/imgs/hotel/A/<?= $val['picture'] ?>">
                            </img>
                        </td>
                        <td><?= $val['address'] ?></td>
                        <td>
                            <input type="hidden" name="hotel_sid" value="<?= $val['sid'] ?>">
                            <input type="hidden" name="hotel_name" value="<?= $val['hotel_name'] ?>">
                        </td>
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
                            <a href="javascript: removeticket(<?= $val['sid'] ?>)">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </td>
                        <td><?= $val['product_name'] ?></td>
                        <td><img style="width: 200px;" src="./../imgs/tickets_imgs/<?= $val['product_imgs'] ?>" alt=""></td>
                        <td><?= $val['product_introduction'] ?></td>
                        <td><?= $val['product_price'] ?></td>
                        <td>
                            <p><?= $val['qty'] ?></p>
                        </td>
                        <td><?= $val['product_price'] * $val['qty']; ?></td>
                    <?php } ?>
                    <td>
                        <input type="hidden" name="ticket_sid" value="<?= $val['sid'] ?>">
                        <input type="hidden" name="ticket_name" value="<?= $val['product_name'] ?>">
                        <input type="hidden" name="ticket_quantity" value="<?= $val['qty'] ?>">
                        <input type="hidden" name="ticket_total_price" value="<?= $val['product_price'] * $val['qty']; ?>">
                    </td>

                    </tr>
            </tbody>
        </table>
        <?php if (empty($_SESSION['admin'])) : ?>
            <div>
                <p>請先登入後再進行結帳</p>
            </div>
        <?php elseif (empty($_SESSION['food-cart']) and empty($_SESSION['hotel-cart']) and empty($_SESSION['ticket-cart'])) : ?>
            <div>
                <p>購物車目前空無一物喔！</p>
            </div>
        <?php else : ?>
            <input type="submit" id="submit" value="結帳">
        <?php endif ?>
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
    function removefood(sid) {
        location.href = `remove-from-cart-food.php?sid=${sid}`;
    }

    function removehotel(sid) {
        location.href = `remove-from-cart-hotel.php?sid=${sid}`;
    }

    function removeticket(sid) {
        location.href = `remove-from-cart-ticket.php?sid=${sid}`;
    }
</script>
<?php include __DIR__ . '/../parts/html-foot.php'; ?>