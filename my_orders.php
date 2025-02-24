<?php
session_start();
?>
<style>
	<?php include "CSS/my-orders.css" ?>
</style>
<?php

if (!isset($_SESSION["user"])) {
	header("Location:index.php");
}
require_once "./functions/database_functions.php";

$title = "My orders";
require "./template/header.php";

$conn = db_connect();

$pending_orders = getPendingOrders($conn);
?>
<div class="order-tracker">
	<h1 class="process-header">Orders</h1>
	<?php
	if (mysqli_num_rows($pending_orders) != 0) {
		?>
		<div class="order-container">
			<?php
			while ($query_row = mysqli_fetch_assoc($pending_orders)) {
				$placedClass = ($query_row['order_status'] === 'placed' || $query_row['order_status'] === 'confirmed' || $query_row['order_status'] === 'processing' || $query_row['order_status'] === 'shipping' || $query_row['order_status'] === 'delivered') ? 'completed' : '';
				$confirmClass = in_array($query_row['order_status'], ['confirmed', 'processing', 'shipping', 'delivered']) ? 'completed' : ($query_row['order_status'] === 'placed' ? 'active pending' : '');
				$processingClass = in_array($query_row['order_status'], ['processing', 'shipping', 'delivered']) ? 'completed' : ($query_row['order_status'] === 'confirmed' ? 'active pending' : '');
				$shippingClass = in_array($query_row['order_status'], ['shipping', 'delivered']) ? 'completed' : ($query_row['order_status'] === 'processing' ? 'active pending' : '');
				$deliveredClass = ($query_row['order_status'] === 'delivered') ? 'completed' : (($query_row['order_status'] === 'shipping') ? 'active pending' : '');
				?>
				<div class="order-detail">
					<div class="tracking-steps">
						<div class="step <?php echo $placedClass ?>">
							<div class="step-icon">✓</div>
							<div class="step-text">Order Placed</div>
							<div class="step-date"><?php echo date("g:i A, M d, Y", strtotime($query_row['order_date'])) ?>
							</div>
						</div>
						<div class="step <?php echo $confirmClass ?>">
							<div class="step-icon">📝</div>
							<div class="step-text">Confirmation</div>
							<div class="step-date"> <?php
							if (in_array($query_row['order_status'], ['confirmed', 'processing', 'shipping', 'delivered'])) {
								echo 'Completed';
							} else {
								echo 'Pending';
							}
							?></div>
						</div>
						<div class="step <?php echo $processingClass ?>">
							<div class="step-icon">📦</div>
							<div class="step-text">Processing</div>
							<div class="step-date">
								<?php
								if (in_array($query_row['order_status'], ['processing', 'shipping', 'delivered'])) {
									echo "Completed";
								} else {
									echo 'Pending';
								}
								?>
							</div>
						</div>
						<div class="step <?php echo $shippingClass ?>">
							<div class="step-icon">🚚</div>
							<div class="step-text">Shipping</div>
							<div class="step-date"> <?php
							if (in_array($query_row['order_status'], ['shipping', 'delivered'])) {
								echo "Completed";
							} else {
								echo 'Pending';
							}
							?></div>
						</div>
						<div class="step <?php echo $deliveredClass ?>">
							<div class="step-icon">✅</div>
							<div class="step-text">Delivered</div>
							<div class="step-date">
								<?php
								if ($query_row['order_status'] === 'delivered') {
									echo "Completed";
								} else {
									echo 'Pending';
								}
								?>
							</div>
						</div>
					</div>
					<ul>
						<li>Order ID: <?php echo $query_row["order_id"] ?></li>
						<li>Customer ID: <?php echo $query_row["customer_id"] ?></li>
						<li>Quantity: <?php echo $query_row["quantity"] ?></li>
						<li>Total Price: <?php echo $query_row["total_price"] ?></li>
					</ul>

				</div>
				<?php
			}
			?>
		</div>




		<?php
	}
	?>


</div>




<!-- <script>

	window.setTimeout(function () {

		window.location.href = "http://localhost/book_store_system/index.php";

	}, 3000);

</script> -->