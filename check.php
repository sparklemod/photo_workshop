<?php
// Скрипт проверки
include 'db_connection.php';

// Соединямся с БД
$link = getConnection();

$isLogin = false;

session_start();
if (isset($_SESSION['id']))
{
    $isLogin = true;
}
else
{
    $isLogin = false;
}

?>