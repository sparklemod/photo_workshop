<?php 
include "header.php";
?>
	<main class="pt-5">
		<div class="container">
			<?php
			if ($isLogin)
			{
				$link = getConnection();
				$query = mysqli_query($link, "SELECT * FROM orders WHERE userid = '".intval($_SESSION['id'])."'");
    			$rows_count = mysqli_num_rows($query);
				
				function dateToText($date){
					list($year, $month, $day) = explode('-', $date);
					return $day . "." . $month . "." . $year;
				}
				
				unset($_SESSION["order_id"]);
				?>

				<h4 class="text-gray mb-5">Заказы</h4>
				<div class="form-group  mb-5">
					<a class="btn btn-accent text-white"  href="add_order.php">Добавить новый</a>
				</div>
				
				<?php
				if ($rows_count == 0){
					?>
					<h6 class="text-gray mb-5">У вас нет активных заказов</h6>
					<?php 
				} else {
					?>
					<table id="orders">
						<thead>
						<tr>
							<td>№ заказа</td>
							<td>Дата оформления</td>
							<td>Цена</td>
							<td>Тип фотосессии</td>
							<td>Адрес фотосессии</td>
							<td>Дата фотосессии</td>
							<td>Время фотосессии</td>
							<td>Длительность фотосессии</td>
							<td>Действия</td>
						</tr>
						</thead>
						<tbody>
					<?php 
					while($order = mysqli_fetch_assoc($query)) {
						?>
							<tr>
								<td><?php echo $order["id"]; ?></td>
								<td><?php echo dateToText($order['order_date']); ?></td>
								<td><?php echo $order["price"]; ?></td>
								<td><?php echo $order["type"]; ?></td>
								<td><?php echo $order["photosession_address"]; ?></td>
								<td><?php echo dateToText($order['photosession_date']); ?></td>
								<td><?php list($h, $m, $s) = explode(':', $order['photosession_time']);
									echo $h . ":" . $m; ?></td>
								<td><?php echo $order["photosession_timelength"]; ?></td>
								<td>
									<form method="POST" action="actions.php">
									<input type="hidden" name="order-action">
									<input type="hidden" name="id" value=<?php echo '"'.$order["id"].'"'; ?>>
									<?php
										if (!$order["price_paid"]){ ?> 
											<button name="pay">Оплатить</button>
											<?php } else { ?>
											<button disabled>Оплачено</button>
									<?php } ?>
									<button  name="change">Изменить</button>
									<button  name="cancel">Отменить</button>
									</form>
								</td>
							</tr>
						<?php 
					}
					?>
						</tbody>
					</table>
					<?php 
    			}
				?>
			<?php } else { 
				header("Location: noaccess.php"); 
			} ?>
		</div>
	</main>
<?php 
include "footer.php";
?>