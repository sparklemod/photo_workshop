<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<script src="js.js"></script>
</head>
<body>
	<?php 
		include "check.php";
	?>
	<header class="header py-4">
		<div class="container border-bottom pb-4">
			<div class="row">
				<div class="col-lg-3">
					<img src="src/logo.png" alt="Логотип" class="logo">
				</div>
				<div class="col-lg-6">
					<nav class="nav justify-content-center">
						<?php
							$pagename = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), ".php");
						?>
						<a <?php echo 'class="nav-link text-white' . (($pagename == "" || $pagename == "index") ? " active" : "") . '"'; ?> href="index.php">Портфолио</a>
						<a <?php echo 'class="nav-link text-white' . ($pagename ==      "reviews" ? " active" : "") . '"'; ?> href="reviews.php">Отзывы</a>
						<a <?php echo 'class="nav-link text-white' . ($pagename == "contacts" ? " active" : "") . '"'; ?> href="contacts.php">Контакты</a>
					</nav>
				</div>

				<div class="col-lg-3">
					<?php 
						if ($isLogin){ ?>
							<button id="account_btn" class="open-button" onclick="toggleForm()">Аккаунт</button>
							<div class="form-popup" id="myForm" style="display: none">
								<form method="POST" action="actions.php" class="profile-form">
									<input type="hidden" name="leave">
									<a class="profile-btn">Профиль</a>
									<a class="profile-btn">Настройки</a>

									<button type="submit" class="profile-btn">Выйти</button>
								</form>
							</div>
						<?php } else { ?>
							<button class="open-button" onclick="toggleForm()">Войти</button>	
							<a class="open-button" href="signup.php">Регистрация</a>		
							<div class="form-popup" id="myForm" style="display: none">
								<form method="POST" action="actions.php" class="form-container" >
									<input type="hidden" name="enter">
								    <div class="popup-title">Авторизация</div>

								    <label for="email"><b>Email</b></label>
								    <input type="text" placeholder="Email" name="login" required>

								    <label for="password"><b>Password</b></label>
								    <input type="password" placeholder="Пароль" name="password" required>

								    <button type="submit" class="btn">Войти</button>
								    <button type="button" class="close" onclick="closeForm()"></button>
								</form>
							</div>
						<?php } ?>
				</div>

			</div>
			
		</div>

		<div class="container">
			<h1 class="text-white text-center my-4"><?php
				if ($pagename == "index") echo "Портфолио";
				else if ($pagename == "reviews") echo "Отзывы";
				else if ($pagename == "contacts") echo "Контакты";
			?></h1>
		</div>
	</header>
