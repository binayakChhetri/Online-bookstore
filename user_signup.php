<?php
session_start();
$title = "User Signup";
require "./functions/database_functions.php";
$conn = db_connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$firstname = trim($_POST['firstname']);
	$lastname = trim($_POST['lastname']);
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);
	$address = trim(trim($_POST['address']));
	$city = trim($_POST['city']);
	$zipcode = trim($_POST['zipcode']);

	$hashedPassword = md5($password);

	$findUser = "SELECT * FROM customers WHERE email = ?";
	echo $findUser;

	$stmt = mysqli_prepare($conn, $findUser);
	mysqli_stmt_bind_param($stmt, "s", $email);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_store_result($stmt);

	if (mysqli_stmt_num_rows($stmt) > 0) {
		header("Location: signup.php?error=email_exists");
		exit();
	}
	mysqli_stmt_close($stmt);

	$insertUser = "INSERT INTO customers (firstname, lastname, email, address, password, city, zipcode) VALUES (?, ?, ?, ?, ?, ?, ?)";
	$stmt = mysqli_prepare($conn, $insertUser);
	mysqli_stmt_bind_param($stmt, "sssssss", $firstname, $lastname, $email, $address, $hashedPassword, $city, $zipcode);

	if (mysqli_stmt_execute($stmt)) {
		mysqli_stmt_close($stmt);
		header("Location: signin.php?signup=success");
		exit();
	} else {
		mysqli_stmt_close($stmt);
		header("Location: ../onlinebookstore/signup.php?error=signup_failed");
		exit();
	}
}
?>

<?php
if (isset($conn)) {
	mysqli_close($conn);
}
?>