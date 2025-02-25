<?php
session_start();
?>
<?php

if (!isset($_SESSION["user"])) {
	header("Location:signin.php");
	exit();
}


?>
<style>
	<?php include "CSS/my-orders.css" ?>
</style>
<?php

require_once "./functions/database_functions.php";

$title = "My orders";
require "./template/header.php";

$conn = db_connect();
$customer_id = $_SESSION['customerid'];
$pending_orders = getPendingOrders($conn, $customer_id);
?>
<div class="order-tracker">
	<?php
	if (mysqli_num_rows($pending_orders) != 0) {
		echo "<h1 class='process-header'>Order Status</h1>";
		?>
		<div class="order-container">
			<?php
			while ($query_row = mysqli_fetch_assoc($pending_orders)) {
				$book_info = json_decode($query_row['book_info'], true);
				$placedClass = ($query_row['order_status'] === 'placed' || $query_row['order_status'] === 'confirmed' || $query_row['order_status'] === 'processing' || $query_row['order_status'] === 'shipping' || $query_row['order_status'] === 'delivered') ? 'completed' : '';
				$confirmClass = in_array($query_row['order_status'], ['confirmed', 'processing', 'shipping', 'delivered']) ? 'completed' : ($query_row['order_status'] === 'placed' ? 'active pending' : '');
				$processingClass = in_array($query_row['order_status'], ['processing', 'shipping', 'delivered']) ? 'completed' : ($query_row['order_status'] === 'confirmed' ? 'active pending' : '');
				$shippingClass = in_array($query_row['order_status'], ['shipping', 'delivered']) ? 'completed' : ($query_row['order_status'] === 'processing' ? 'active pending' : '');
				$deliveredClass = ($query_row['order_status'] === 'delivered') ? 'completed' : (($query_row['order_status'] === 'shipping') ? 'active pending' : '');
				?>
				<div class="order-detail">
					<?php if ($query_row['order_status'] !== "Cancelled") {
						?>
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
						<?php
					} else {
						?>
						<h1 class="process-header">This order has been cancelled</h1>
						<?php
					} ?>
					<ul>
						<li>Order ID: <?php echo $query_row["order_id"] ?></li>
						<li>Customer ID: <?php echo $query_row["customer_id"] ?></li>
						<li>Quantity: <?php echo $query_row["quantity"] ?></li>
						<li>Total Price: <?php echo $query_row["total_price"] ?></li>
						<li>Book Title:
							<?php foreach ($book_info as $key => $value) {
								$books = getBookByIsbn($conn, $key);
								$book = mysqli_fetch_assoc($books);
								echo "<br>";
								echo $book['book_title'];
							} ?>
						</li>
					</ul>

				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		echo "<h1 class='process-header'>No orders to track.</h1>";
	}
	?>


</div>




<!-- <script>

	window.setTimeout(function () {

		window.location.href = "http://localhost/book_store_system/index.php";

	}, 3000);

</script> -->