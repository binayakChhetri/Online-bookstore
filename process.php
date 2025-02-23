<style>
	<?php include "CSS/process.css" ?>
</style>
<?php
session_start();
if (!isset($_SESSION["user"])) {
	header("Location:index.php");
}
require_once "./functions/database_functions.php";
// print out header here
$title = "Purchase Process";
require "./template/header.php";


// connect database
$conn = db_connect();

$firstname = trim($_POST['firstname']);
$firstname = mysqli_real_escape_string($conn, $firstname);

$lastname = trim($_POST['lastname']);
$lastname = mysqli_real_escape_string($conn, $lastname);


$address = trim(trim($_POST['address']));
$address = mysqli_real_escape_string($conn, $address);

$city = trim($_POST['city']);
$city = mysqli_real_escape_string($conn, $city);

$zipcode = trim($_POST['zipcode']);
$zipcode = mysqli_real_escape_string($conn, $zipcode);

// find customer
$customer = getCustomerIdbyEmail($_SESSION['email']);
$id = $customer['id'];
$query = "UPDATE customers set 
	firstname='$firstname', lastname='$lastname' , address='$address', city='$city', zipcode='$zipcode'  where id='$id'
	";
mysqli_query($conn, $query);
$date = date("Y-m-d H:i:s");
// insertIntoOrder($conn, $customer['id'], $_SESSION['total_price'],$date);
insertIntoCart($conn, $customer['id'], $date);

// take orderid from order to insert order items
// $orderid = getOrderId($conn, $customer['id']);
$Cartid = getCartId($conn, $customer['id']);

foreach ($_SESSION['cart'] as $isbn => $qty) {
	$bookprice = getbookprice($isbn);
	$query = "INSERT INTO cartItems(cartid,productid,quantity) VALUES 
		('$Cartid', '$isbn', '$qty')";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		echo "Insert value false!" . mysqli_error($conn2);
		exit;
	}
}

$_SESSION["order_status"] = "order_placed";
echo ($_SESSION["total_price_with_delivery"]);
"<br/>";
echo ($_SESSION['total_items']);
"<br/>";
var_dump($_SESSION['cart']);

echo ($_SESSION["customerid"]);
echo $_SESSION["order_status"];

?>
<div class="order-tracker">
	<h1 class="process-header">Order Tracker</h1>
	<div class="tracking-steps">
		<div class="step completed">
			<div class="step-icon">✓</div>
			<div class="step-text">Order Placed</div>
			<div class="step-date">Mar 15, 2024</div>
		</div>
		<div class="step active pending">
			<div class="step-icon">📝</div>
			<div class="step-text">Confirmation</div>
			<div class="step-date">Pending</div>
		</div>
		<div class="step">
			<div class="step-icon">📦</div>
			<div class="step-text">Processing</div>
			<div class="step-date">Mar 16, 2024</div>
		</div>
		<div class="step">
			<div class="step-icon">🚚</div>
			<div class="step-text">Shipping</div>
			<div class="step-date">Mar 17, 2024</div>
		</div>
		<div class="step">
			<div class="step-icon">✅</div>
			<div class="step-text">Delivered</div>
			<div class="step-date">Expected Mar 19</div>
		</div>
	</div>
</div><!-- <script>

	window.setTimeout(function () {

		window.location.href = "http://localhost/book_store_system/index.php";

	}, 3000);

</script> -->