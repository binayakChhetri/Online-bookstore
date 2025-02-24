<?php
session_start();
require_once "./functions/database_functions.php";
$conn = db_connect();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "POST REQUEST WAS MADE";

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

    $_SESSION["order_status"] = "placed";

    $bookinfo = json_encode($_SESSION['cart']);
    $price = $_SESSION["total_price_with_delivery"];
    $total_items = $_SESSION['total_items'];
    $customerid = $_SESSION['customerid'];
    $order_status = $_SESSION["order_status"];

    $orderQuery = "INSERT INTO orders (
		customer_id,
		book_info,
		quantity, 
		total_price,
		order_status,
		order_date
	) VALUES (    
		'$customerid',        
		'$bookinfo',     
		'$total_items',                
		'$price',            
		'$order_status',        
		NOW()             
	)";

    mysqli_query($conn, $orderQuery);

    unset($_SESSION['cart']);
    unset($_SESSION['total_items']);
    unset($_SESSION['total_price_with_delivery']);
    unset($_SESSION['order_status']);
}

header('Location: my_orders.php');
?>