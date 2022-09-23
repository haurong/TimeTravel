<?php
header('Content-Type: application/json');

$folder = __DIR__ . '/../../imgs/site/';

$extMap = [
    'image/jpeg'=>'.jpg',
    'image/png'=>'.png',
];


$output = [
    'success' => false,
    'error' => '',
    'data' =>[],
    'files' => $_FILES,   
];

if(empty($_FILES['realpicture'])){
    $output['error'] = '沒有上傳檔案';
    echo json_encode($output,JSON_UNESCAPED_UNICODE);
    exit;
}

// $ext 副檔名對應 
$ext = $extMap[$_FILES['realpicture']['type']];

if(empty($ext)){
    $output['error'] = '檔案格式錯誤：要ＪＰＥＧ，ＰＮＧ';
    echo json_encode($output , JSON_UNESCAPED_UNICODE);
    exit;
}

// 改成隨機黨名
$filename = md5($_FILES['realpicture']['name'].uniqid()).$ext;
$output['filename'] = $filename;

if(! 
    move_uploaded_file(
        $_FILES['realpicture']['tmp_name'],$folder.$filename
        )
    ){
    $output['error'] = '無法移動上傳檔案，注意資料夾權限問題';
    echo json_encode($output , JSON_UNESCAPED_UNICODE);
    exit;
}
$output['success'] = true;

echo json_encode($output, JSON_UNESCAPED_UNICODE);
