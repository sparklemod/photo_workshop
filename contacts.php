<?php 
include "header.php";
?>
	<main class="pt-5">
		<div class="container">
			<h2 class="text-gray mb-5">Свяжитесь с нами!</h2>
			<div class="row">
				<div class="col-lg-4">
					<div class="row mb-5">
						<div class="col-lg-3">
							<svg width="4em" height="4em" viewBox="0 0 16 16" class="bi bi-house-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" d="M8 3.293l6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
								<path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
							</svg>
						</div>
						<div class="col-lg-9">
							<p>г. Екатеринбург<br>ул. Чернышевского, 7</p>
						</div>
					</div>
					<div class="row mb-5">
						<div class="col-lg-3">
							<svg width="4em" height="4em" viewBox="0 0 16 16" class="bi bi-telephone-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" d="M2.267.98a1.636 1.636 0 0 1 2.448.152l1.681 2.162c.309.396.418.913.296 1.4l-.513 2.053a.636.636 0 0 0 .167.604L8.65 9.654a.636.636 0 0 0 .604.167l2.052-.513a1.636 1.636 0 0 1 1.401.296l2.162 1.681c.777.604.849 1.753.153 2.448l-.97.97c-.693.693-1.73.998-2.697.658a17.47 17.47 0 0 1-6.571-4.144A17.47 17.47 0 0 1 .639 4.646c-.34-.967-.035-2.004.658-2.698l.97-.969z"/>
							</svg>
						</div>
						<div class="col-lg-9">
							<p>+7(343)-207-07-80<br>8-904-984-964-8</p>
						</div>
					</div>
					<div class="row mb-5">
						<div class="col-lg-3">
							<svg width="4em" height="4em" viewBox="0 0 16 16" class="bi bi-envelope-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
							</svg>
						</div>
						<div class="col-lg-9">
							<!--<p class="center" style="margin-top: 16px;">callisto-foto@mail.ru</p> -->
							<p class="center">callisto-foto@mail.ru</p> 
						</div>
					</div>

					
				</div>
				<div class="col-lg-8">
					<form>
						<div class="form-group">
							<input type="text" class="form-control" id="name" placeholder="Имя*">
						</div>
						<div class="form-group">
							<input type="email" class="form-control" id="login" placeholder="Email*">
						</div>
						<div class="form-group">
							<input type="phone" class="form-control" id="login" placeholder="Номер телефона*">
						</div>
						<div class="form-group">
							<textarea class="form-control" placeholder="Опишите ваш запрос*"></textarea>	
						</div>
						<button type="submit" class="btn btn-accent text-white">Отправить</button>
					</form>
				</div>
			</div>
		</div>
	</main>
	
<?php 
include "footer.php";
?>