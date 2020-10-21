<?php
// Страница авторизации

// Функция для генерации случайной строки
function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];
    }
    return $code;
}

function login($link){
        // Вытаскиваем из БД запись, у которой логин равняеться введенному
        $query = mysqli_query($link,"SELECT user_id, user_login, user_password FROM users WHERE user_login='".mysqli_real_escape_string($link,$_POST['login'])."' LIMIT 1");
        $data = mysqli_fetch_assoc($query);

        // Сравниваем пароли
        if($data != null && $data['user_password'] === md5(md5($_POST['password'])))
        {
            // Генерируем случайное число и шифруем его
            $hash = md5(generateCode(10));

            $insip = ", user_ip=INET_ATON('".$_SERVER['REMOTE_ADDR']."')";

            // Записываем в БД новый хеш авторизации и IP
            mysqli_query($link, "UPDATE users SET user_hash='".$hash."' ".$insip." WHERE user_id='".$data['user_id']."'");

            // Ставим куки
            setcookie("id", $data['user_id'], time()+60*60*24*30, "/");
            setcookie("hash", $hash, time()+60*60*24*30, "/", null, null, true); // httponly !!!

            //// Переадресовываем браузер на страницу проверки нашего скрипта
            header("Location: index.php"); 
        } else {
            echo '<h1>Неправильный логин или пароль</h1>';
        }
}


if ($_SERVER['REQUEST_METHOD'] == "POST"){
    
    include 'db_connection.php';

    ////Код для авторизации

    if(isset($_POST['enter']) && isset($_POST['login']) && isset($_POST['password']))
    {

        // Соединямся с БД
        $link = getConnection();

        login($link);
        
    } 

    ////код для выхода из аккаунта 
    
    elseif (isset($_POST['leave']) && isset($_COOKIE["id"])) 
    {
        $link = getConnection();
        // cтираем временные данные о пользователе (id, хэш, куки)
        mysqli_query($link, "UPDATE users SET user_hash='' WHERE user_id='".$_COOKIE["id"]."'");

        setcookie("id", null, -1, "/");
        setcookie("hash", null, -1, "/", null, null, true); // httponly !!!

        header("Location: index.php"); 
    } 
    elseif (isset($_POST['signup']) && isset($_POST['login']) && isset($_POST['password'])){
        $link = getConnection();

        // Вытаскиваем из БД запись, у которой логин равняеться введенному
        $query = mysqli_query($link, "SELECT user_login, user_password FROM users WHERE user_login='".mysqli_real_escape_string($link,$_POST['login'])."' LIMIT 1");
        $data = mysqli_fetch_assoc($query);

        if(!$data || $data['user_login'] !== $_POST['login']){

            $query = mysqli_query($link,"INSERT INTO users (user_login, first_name, last_name, user_password) VALUES ('" .
                mysqli_real_escape_string($link, $_POST['login']) . "', '" . 
                mysqli_real_escape_string($link, $_POST['first-name']) . "', '" . 
                mysqli_real_escape_string($link, $_POST['last-name']) . "', '" . 
                md5(md5($_POST['password'])) . "')");

            if ($query){
                login($link);
            } else {
                echo '<h1>Ошибка при регистрации</h1>';
            }

            
        } else {
            echo '<h1>Пользователь уже зарегистрирован</h1>';
        }
    }
    else
    {
        http_response_code (406);
    }
    
    exit();
}




?>