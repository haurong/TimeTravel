<?php

$db_host = '192.168.35.119';
$db_name = 'project';
$db_user = 'project';
$db_pass = '123';

// data source name
$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8";

$pdo_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

$pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);

if (!isset($_SESSION)) {
    session_start();
}
$pageName = '';  // 預設值
