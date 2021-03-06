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
        // Вытаскиваем из БД запись, у которой логин равняется введенному
        $query = mysqli_query($link,"SELECT user_id, user_login, user_password FROM users WHERE user_login='".mysqli_real_escape_string($link,$_POST['login'])."' LIMIT 1");
        $data = mysqli_fetch_assoc($query);

        // Сравниваем пароли
        if($data != null && $data['user_password'] === md5(md5($_POST['password'])))
        {
            // Ставим куки
            $_SESSION["id"] = $data['user_id'];

            //// Переадресовываем браузер на страницу проверки нашего скрипта
            header("Location: index.php"); 
        } else {
            echo '<h1>Неправильный логин или пароль</h1>';
        }
}

function saveFile($file, $id){
	if (isset($_FILES['task_file']) && $_FILES['task_file']["size"] > 0){
		$file = $_FILES['task_file'];
		var_dump($file);
		$filename = "order" . $id . "-" . preg_replace("/[^A-Za-z0-9._-]/i", "", $file["name"]);
		$moved = move_uploaded_file($file["tmp_name"], "./files/" . $filename);
		if (!$moved) {
			echo '<h1>Не получилось переместить файл</h1>';
			$file = "";
		} else {
			$file = $filename;
		}
	} else {
		$file = "";
	}
	return $file;
}

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    
    include 'functions.php';

    ////Код для авторизации

    if(isset($_POST['enter']) && isset($_POST['login']) && isset($_POST['password']))
    {

        // Соединямся с БД
        $link = getConnection();

        login($link);
        
    } 

    ////код для выхода из аккаунта 
    
    elseif (isset($_POST['leave']) && isset($_SESSION["id"])) 
    {
        $link = getConnection();

        unset($_SESSION["id"]);

        header("Location: index.php"); 
    } 

    ////код для регистрации

    elseif (isset($_POST['signup']) && isset($_POST['login']) && isset($_POST['password'])){
        $link = getConnection();

        // Вытаскиваем из БД запись, у которой логин равняеться введенному
        $query = mysqli_query($link, "SELECT user_login, user_password FROM users WHERE user_login='".mysqli_real_escape_string($link,$_POST['login'])."' LIMIT 1");
        $data = mysqli_fetch_assoc($query);

        if(!$data || $data['user_login'] !== $_POST['login']){

            $query = mysqli_query($link,"INSERT INTO orders (user_login, first_name, last_name, user_password) VALUES ('" .
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
	
	/// добавить новый заказ
	elseif (isset($_POST['new-order']) && isset($_SESSION["id"])) {
		$link = getConnection();
		
		$price = mysqli_query($link, "SELECT price FROM order_types WHERE name='" . mysqli_real_escape_string($link, $_POST['type']) . "';");
		$price = mysqli_fetch_assoc($price)["price"];
		
		$query = mysqli_query($link,
			"INSERT INTO orders (userid, type, order_date, price, price_paid, photosession_date,
			photosession_address, photosession_time, photosession_timelength) VALUES (" .
                mysqli_real_escape_string($link, $_SESSION["id"]) . ", '" . 
				mysqli_real_escape_string($link, $_POST['type']) . "', " . 
                "DATE(NOW())," .
				$price * intval(mysqli_real_escape_string($link, $_POST['photosession_timelength'])) . ", " . 
				"false, '" . 
				mysqli_real_escape_string($link, $_POST['photosession_date']) . "', '" . 
                mysqli_real_escape_string($link, $_POST['photosession_address']) . "', '" . 
				mysqli_real_escape_string($link, $_POST['photosession_time']) . "', " . 
				mysqli_real_escape_string($link, $_POST['photosession_timelength']) . ");"
        );
		
		$id = mysqli_insert_id ($link);
		$file = saveFile($_FILES["task_file"], $id);
		if ($file != ""){
			$query = mysqli_query($link,
				"UPDATE orders SET task_file='" . $file .  "' WHERE id=" . $id . ";"
			);
		}
		
        if ($query){
            header("Location: orders.php"); 
        } else {
            echo '<h1>Ошибка при заполнении базы данных</h1>';
        }
	}
	
	/// редактировать заказ
	elseif (isset($_POST['change-order']) && isset($_SESSION["id"])) {
		$link = getConnection();
		
		$query = mysqli_query($link,
			"UPDATE orders SET photosession_date='".
				mysqli_real_escape_string($link, $_POST['photosession_date']) . "', " .
				"photosession_address='".
				mysqli_real_escape_string($link, $_POST['photosession_address']) . "', " .
				"photosession_time='".
				mysqli_real_escape_string($link, $_POST['photosession_time']) . "', " .
				"photosession_timelength=".
				mysqli_real_escape_string($link, $_POST['photosession_timelength']) . " WHERE id=" . $_POST['id'] . ";"
        );
		
		$file = saveFile($_FILES["task_file"], $_POST['id']);
		if ($file != ""){
			$query = mysqli_query($link,
				"UPDATE orders SET task_file='" . $file .  "' WHERE id=" . $_POST['id'] . ";"
			);
		}

		unset($_SESSION['order_id']);
		
        if ($query){
            header("Location: orders.php"); 
        } else {
            echo '<h1>Ошибка при заполнении базы данных</h1>';
			echo mysqli_error($link);
        }
	}
	
	/// совершить действие над заказом
	elseif (isset($_POST['order-action']) && isset($_SESSION["id"])) {
		$link = getConnection();
		$id = intval($_POST['id']);
		
		echo "userid=" . $_SESSION["id"] . ", id=" . $id . ";";
		if (isset($_POST['pay']))
		{
			$query = mysqli_query($link,
				"UPDATE orders SET price_paid=true WHERE userid=" . $_SESSION["id"] . " and id=" . $id . ";");
			header("Location: orders.php"); 

		}
		elseif (isset($_POST['change']))
		{
			$_SESSION['order_id'] = $id;
			header("Location: add_order.php"); 
		}
		elseif (isset($_POST['cancel']))
		{
			$file = mysqli_query($link,"SELECT task_file FROM userid=" . $_SESSION["id"] . " and id=" . $id . ";");
			$file = mysqli_fetch_assoc($file )["task_file"];
			if ($file != "")
				unlink("./files/" . $file);
			
			$query = mysqli_query($link,
				"DELETE FROM orders WHERE userid=" . $_SESSION["id"] . " and id=" . $id . ";");
			header("Location: orders.php"); 
		}
	}

    ////некорректные запросы

    else
    {
        http_response_code (406);
    }
    
    exit();
}

?>