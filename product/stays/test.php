<?php require __DIR__ . '/../../parts/connect_athome_db.php';
$area = "SELECT * 
FROM `area`
WHERE 1
ORDER BY area_sid";

$county = "SELECT * 
FROM `city`
WHERE 1
ORDER BY city_sid";

$hotelcategories = "SELECT * 
FROM `hotel_categories`
WHERE 1
ORDER BY hotel_categories_sid";

$rowarea = $pdo->query($area)->fetchAll();
$rowcounty = $pdo->query($county)->fetchAll();
$rowhotelcategories = $pdo->query($hotelcategories)->fetchAll();
?>
<?php include __DIR__ . '/../../parts/html-head.php'; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>   
    <form name="form1" onsubmit="checkForm(); return false">
        <input type="file" name="img" id="img">
        <button type="submit" class="btn btn-primary" id="submitbtn">Submit</button>
    </form>


    <script>
        let area = <?php 
        echo json_encode($rowarea, JSON_UNESCAPED_UNICODE) 
        ?>;
        let county = <?php 
        echo json_encode($rowcounty, JSON_UNESCAPED_UNICODE) 
        ?>;
        let hotelcategories = <?php 
        echo json_encode($rowhotelcategories, JSON_UNESCAPED_UNICODE) 
        ?>;

        console.log(area);
        console.log(county);  
        console.log(hotelcategories);
    
    
    </script>
</body>

</html>
<?php include __DIR__ . '/../../parts/script.php';?>
<?php include __DIR__ . '/../../parts/html-foot.php'; ?>