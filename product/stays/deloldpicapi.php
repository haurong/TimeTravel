<?php
header('Content-Type: application/json');


$folder = __DIR__ . '/../../imgs/hotel/A/';

$delfiles = $_POST['delname'];
$output = [
    'success' => false,
    'files' => $delfiles
];
fopen($folder.$delfiles,'w+');

if(!unlink($folder.$delfiles))
{
    $output = [
        'success' => false,
        'files' => $delfiles,
        'error' => '刪除失敗'
    ];
}
else
{
    $output = [
        'success' => true,
        'files' => $delfiles,
        'error' => '刪除成功'
    ];
}


echo json_encode($output, JSON_UNESCAPED_UNICODE);
?>