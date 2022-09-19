<?php require __DIR__ . '/../../parts/connect_db.php'; 
$pageName = 'basepage';

?>
<?php include __DIR__ . '/../../parts/html-head.php'; ?>
<?php include __DIR__ . '/../../parts/navbar.php'; ?>
<div class="container">
<select name="categories" id="categories" >
    <option value=""><a type="button" href="././food-list.php">特色小吃</a></option>
    <option value=""><a href="food-list.php">台式料理</a></option>
    <option value="">日式料理</option>
    <option value="">泰式料理</option>
    <option value="">火鍋</option>
    <option value="">飲品</option>
    <option value="">甜點</option>
    <option value="">咖啡</option>
</select>
</div>

<?php include __DIR__ . '/../../parts/script.php';?>
<?php include __DIR__ . '/../../parts/html-foot.php'; ?>