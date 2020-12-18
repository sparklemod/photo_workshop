<?php 
include "header.php";
?>
	<main class="pt-5">
		<div class="container pb-5">
		<form method="POST" action="actions.php" class="form-signin" enctype="multipart/form-data">
			<?php
			if ($isLogin)
			{
				if (isset($_SESSION["order_id"])){
					$orderId = $_SESSION["order_id"];
				
					$link = getConnection();
					$query = mysqli_query($link, "SELECT * FROM orders WHERE userid = ".intval($_SESSION['id'])." and id = ".intval($orderId));
					$order = mysqli_fetch_assoc($query);
				} else {
					$order = null;
				}
				
				if (!$order){
					?>
					<h1 class="text-gray mb-5">Добавить заказ</h1>
					<input type="hidden" name="new-order">
					<?php 
					$order = array(
						"type" => "",
						"photosession_address" => "ул. Пушкина",
						"photosession_date" => "2000-01-01",
						"photosession_time" => "12:00:00",
						"photosession_timelength" => "1",
						"task_file" => ""
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
				
				<?php 
					if ($order["type"] == ""){
					?>
						<div class="form-group">
							<label>Тип фотосессии</label>
							<select name="type" class="form-control" >
							<?php 
								$types = mysqli_query($link, "SELECT * FROM order_types;");
								while($type = mysqli_fetch_assoc($types)) {
									echo "<option>" . $type["name"] . "</option>";
								}
							?>
							</select>
						</div>
					<?php
					} else {
					?>
						<div class="form-group">
							<label>Тип фотосессии</label>
							<input type="text" class="form-control" readonly
								value=<?php echo '"' . $order["type"] . '"'; ?>  >
						</div>
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
					<label>Дополнительное описание</label>
					<?php 
					if ($order["task_file"] == ""){
						?>
							<input type="file" class="form-control" name="task_file"> 
						<?php 
					} else {
						?>
							<input type="text" class="form-control" readonly value=<?php echo '"' . $order["task_file"]. '"'; ?> >
						<?php 
					}
					?>
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