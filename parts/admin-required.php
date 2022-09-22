<?php
if(! isset($_SESSION)){
    session_start();
}

if(empty($_SESSION['username'])){
    header('Location: login-form.php');
    exit;
}