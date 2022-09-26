<?php 
if (!isset($_SESSION)) {
    session_start();
}
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
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="/./../TimeTravel/./fontawesome/css/all.css">
    <title>TimeTravel</title>
    <style>
        nav {
            height: 80px;
        }
        
    </style>
</head>

<body>