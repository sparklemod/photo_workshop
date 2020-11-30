<?php 
include "header.php";
?>
	<main class="pt-5">
		<div class="container pb-5">
		<form method="POST" action="actions.php" class="form-signin" >
			<?php
			if ($isLogin)
			{
				if (isset($_SESSION["order_id"])){
					$orderId = $_SESSION["order_id"];
				
					$link = getConnection();
					$query = mysqli_query($link, "SELECT * FROM orders WHERE userid = ".intval($_SESSION['id'])." and id = ".intval($orderId));
					$order = mysqli_fetch_assoc($query);
				}
				
				if (!$order){
					?>
					<h1 class="text-gray mb-5">Добавить заказ</h1>
					<input type="hidden" name="new-order">
					<?php 
					$order = array(
						"photosession_address" => "ул. Пушкина",
						"photosession_date" => "2000-01-01",
						"photosession_time" => "12:00:00",
						"photosession_timelength" => "1",
						"add_comment" => ""
					);
				} else {
					?>
					<h1 class="text-gray mb-5">Редактировать заказ</h1>
					<label>Заказ №<?php echo $order["id"]; ?></label>
					<input type="hidden" name="change-order">
					<input type="hidden" name="id" value=<?php echo '"' . $order["id"] . '"'; ?>>
					<?php 
				}
    			?>

				<div class="form-group">
					<label>Адрес фотосессии</label>
					<input type="text" class="form-control" name="photosession_address" required
						value=<?php echo '"' . $order["photosession_address"]. '"'; ?>  >
				</div>
				
				<div class="form-group">
					<label>Дата фотосессии</label>
					<input type="date" class="form-control" name="photosession_date" required
						value=<?php echo '"' . $order["photosession_date"]. '"'; ?>  >
				</div>
				
				<div class="form-group">
					<label>Время фотосессии</label>
					<input type="time" class="form-control" name="photosession_time" required
						value=<?php echo '"' . $order["photosession_time"]. '"'; ?>  >
				</div>
				
				<div class="form-group">
					<label>Длительность фотосессии (в часах)</label>
					<input type="number" class="form-control"  min="1" name="photosession_timelength" required
						value=<?php echo '"' . $order["photosession_timelength"]. '"'; ?>  >
				</div>
				
				<div class="form-group">
					<label>Дополнительный комментарий</label>
					<input type="text" class="form-control"  placeholder="Оставьте комментарий здесь" name="add_comment"
						value=<?php echo '"' . $order["add_comment"]. '"'; ?>  >
				</div>
				  
				<button class="btn btn-accent text-white btn-lg  btn-block" type="submit" >Сохранить</button>
			<?php } else { 
				header("Location: noaccess.php"); 
			} ?>
		</form>
		</div>
	</main>
	<script type="text/javascript">
	</script>
<?php 
include "footer.php";
?>