<?php

session_start();  // 啟用 session

unset($_SESSION['admin']);



header('Location: basepage.php');
