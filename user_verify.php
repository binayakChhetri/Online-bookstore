<?php
session_start();
require_once "./functions/database_functions.php";
$conn = db_connect();

$name = trim($_POST['username']);
$pass = trim($_POST['password']);

$hashedPass = md5($pass);

$name = mysqli_real_escape_string($conn, $name);

function check_credentials($table, $userField, $passField, $username, $hashedPassword, $conn)
{
	$query = "SELECT * FROM $table WHERE $userField = ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$result = $stmt->get_result();
	return $result->fetch_assoc();
}

$row = check_credentials('manager', 'name', 'pass', $name, $hashedPass, $conn);
if ($row && $hashedPass === $row['pass']) {
	$_SESSION['manager'] = true;
	unset($_SESSION['expert'], $_SESSION['user'], $_SESSION['email']);
	header("Location: admin_book.php");
	exit();
}

$row = check_credentials('expert', 'name', 'pass', $name, $hashedPass, $conn);
if ($row && $hashedPass === $row['pass']) {
	$_SESSION['expert'] = true;
	unset($_SESSION['manager'], $_SESSION['user'], $_SESSION['email']);
	header("Location: admin_book.php");
	exit();
}

$row = check_credentials('customers', 'email', 'password', $name, $hashedPass, $conn);
// var_dump($row);
if ($row && $hashedPass === $row['password']) {

	$_SESSION['user'] = true;
	$_SESSION['email'] = $name;
	$_SESSION['customerid'] = $row['id'];

	echo $_SESSION['customerid'];
	unset($_SESSION['manager'], $_SESSION['expert']);
	header("Location: index.php");
	exit();
}

header("Location: ../book_store_system/signin.php?signin=invalid");
exit();

if (isset($conn)) {
	mysqli_close($conn);
}
?>