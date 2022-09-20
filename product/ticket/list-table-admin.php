<div class="row">
    <div class="col">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">
                        <i class="fa-solid fa-trash-can"></i>
                    </th>
                    <th scope="col">#</th>
                    <th scope="col">票券代號</th>
                    <th scope="col">票券名稱</th>
                    <th scope="col">價錢</th>
                    <th scope="col">介紹</th>
                    <th scope="col">注意說明</th>
                    <th scope="col">開始日</th>
                    <th scope="col">結束日</th>
                    <th scope="col">封面圖片</th>
                    <th scope="col">產品圖片</th>
                    <th scope="col">分類</th>
                    <th scope="col">區域</th>
                    <th scope="col">狀態</th>
                    <th scope="col">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $r) : ?>
                    <tr>
                        <td>
                            <a href="javascript: delete_it(<?= $r['sid'] ?>)">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </td>
                        <td><?= $r['sid'] ?></td>
                        <td><?= $r['product_number'] ?></td>
                        <td><?= $r['product_name'] ?></td>
                        <td><?= $r['product_price'] ?></td>
                        <td><?= $r['product_introduction'] ?></td>
                        <td><?= $r['product_notice'] ?></td>
                        <td><?= $r['start_day'] ?></td>
                        <td><?= $r['end_day'] ?></td>
                        <td><?= $r['product_cover'] ?></td>
                        <td><?= $r['product_imgs'] ?></td>
                        <td><?= $r['categories_id'] ?></td>
                        <td><?= $r['cities_id'] ?></td>
                        <td><?= $r['on_sale'] ?></td>
                       
                        <td>
                            <a href="edit-form.php?sid=<?= $r['sid'] ?>">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>
</div>