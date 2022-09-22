<?php require __DIR__ . '/../../parts/connect_db.php'; ?>
<?php require __DIR__ . '/site-list-api.php'; ?>
<?php require __DIR__ . '/../../parts/html-head.php'; ?>
<?php include __DIR__ . '/../../parts/navbar.php'; ?>

<div class="container">
    <div class="row">
        <!-- 分類選單 -->
        <div class="col">
            <div class="btn-group">
                <a type="button" href="?" class="btn btn-primary <?= empty($cate) ? 'active' : '' ?>">所有分類</a>
                <?php foreach ($cates as $c) : ?>
                    <a type="button" href="?cate=<?= $c['site_category_sid'] ?>" class="btn btn-primary <?= $cate == $c['site_category_sid'] ? 'active' : '' ?>"><?= $c['site_category_name'] ?></a>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- 分類選單 -->
        
        <div class="col">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page - 1 ?>">
                            <i class="fa-solid fa-circle-arrow-left"></i>
                        </a>
                    </li>

                    <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                        if ($i >= 1 and $i <= $totalPages) :
                            $pageBtnQS['page']=$i;
                    ?>
                            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                <a class="page-link" href ="?<?= http_build_query($pageBtnQS) ?>"><?= $i ?></a>
                            </li>
                    <?php
                        endif;
                    endfor; ?>

                    <li class="page-item <?= $totalPages == $page ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page + 1 ?>">
                            <i class="fa-solid fa-circle-arrow-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <button type="button" class="btn btn-primary" onclick="location.href='site-insert.php'">新增景點</button>
    <!-- <button type="submit" class="btn btn-warning">刪除</button> -->
    <button type="button" class="btn btn-primary" onclick="history.back()">回上一頁</button>
    <div class="row">
        <div class="col">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">
                            <i class="fa-solid fa-trash-can"></i>
                            <!-- <input type="checkbox" onclick="check_all(this,'c')"> -->
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">景點名稱</th>
                        <th scope="col">地區</th>
                        <th scope="col">分類</th>
                        <th scope="col">簡介</th>
                        <th scope="col">照片</th>
                        <th scope="col">網站</th>
                        <th scope="col">detail</th>
                        <th><i class="fa-solid fa-pen-to-square"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $r) : ?>
                        <tr data-sid="<? $r['sid'] ?>">
                            <td>
                                <!-- <input type="checkbox" name="checkbox[]"> -->
                                <a href="javascript: delete_it(<?= $r['sid'] ?>)">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </td>
                            <td><?= $r['sid'] ?></td>
                            <td><?= $r['name'] ?></td>
                            <td><?= $r['city_name'] ?><?= $r['area_name'] ?></td>
                            <td><?= $r['site_category_name'] ?></td>
                            <td><?= $r['description'] ?></td>
                            <td><img style="width: 200px;" src="./../../imgs/site/<?= $r['img_small'] ?>" alt=""></td>
                            <td><a href="<?= $r['website'] ?>">網站</a></td>
                            <td>
                                <a href="site-detail.php?sid=<?= $r['sid'] ?>">detail</a>
                            </td>
                            <td>
                                <a href="site-edit.php?sid=<?= $r['sid']?>">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>


        </div>
    </div>

</div>
<?php include __DIR__ . '/../../parts/script.php'; ?>

<!-- <script>
    function check_all(obj, cName) {
        var checkboxs = document.getElementsByName('checkbox[]');
        for (var i = 0; i < checkboxs.length; i++) {
            checkboxs[i].checked = obj.checked;
        }
    }
</script> -->



<script>
    const table = document.querySelector('table');

    function delete_it(sid) {
        if (confirm(`確定要刪除資料嗎?`)) {
            location.href = `site-del.php?sid=${sid}`;


            // var checkboxs = document.getElementsByName('checkbox');
            // for (var i = checkboxs.length - 1; i > 0; i--) {
            //     var ischecked = checkboxs[i]
            //     if (ischecked == true) {
            //         location.href = `site-del.php?sid=${sid}`
            //     }
            // }

        }
    }
</script>
<?php include __DIR__ . '/../../parts/html-foot.php'; ?>