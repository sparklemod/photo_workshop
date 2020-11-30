<?php 
include "header.php";
?>
	<main class="pt-5">
		<div class="container">
			<?php 
			if ($isLogin){
				$link = getConnection();
				$query = mysqli_query($link, "SELECT * FROM users WHERE user_id = '".intval($_SESSION['id'])."' LIMIT 1");
    			$userdata = mysqli_fetch_assoc($query);
				?>
				<h4 class="text-gray mb-5">Личный кабинет</h4>
				<div class="profile-info-block">
					<label>Имя:</label><span><?php echo $userdata["first_name"] ?></span>
				</div>
				<div class="profile-info-block">
					<label>Фамилия:</label><span><?php echo $userdata["last_name"] ?></span>
				</div>
				<div class="profile-info-block">
					<label>Почта:</label><span><?php echo $userdata["user_login"] ?></span>
				</div>
			<?php } else { 
				header("Location: noaccess.php"); 
			} ?>
		</div>
	</main>
<?php 
include "footer.php";
?>