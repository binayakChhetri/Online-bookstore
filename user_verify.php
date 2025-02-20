<?php
session_start();
require_once "./functions/database_functions.php";
$conn = db_connect();

$name = trim($_POST['username']);
$pass = trim($_POST['password']);

if (empty($name) || empty($pass)) {
	header("Location:../onlinebookstore/signin.php?signin=empty");
	exit();
}

$name = mysqli_real_escape_string($conn, $name);
$pass = mysqli_real_escape_string($conn, $pass);

function check_credentials($table, $username, $password, $conn)
{
	$query = "SELECT name, pass FROM $table WHERE name = ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$result = $stmt->get_result();
	return $result->fetch_assoc();
}

$row = check_credentials('manager', $name, $pass, $conn);
if ($row && $name == $row['name'] && $pass == $row['pass']) {
	$_SESSION['manager'] = true;
	unset($_SESSION['expert'], $_SESSION['user'], $_SESSION['email']);
	header("Location: admin_book.php");
	exit();
}

$row = check_credentials('expert', $name, $pass, $conn);
if ($row && $name == $row['name'] && $pass == $row['pass']) {
	$_SESSION['expert'] = true;
	unset($_SESSION['manager'], $_SESSION['user'], $_SESSION['email']);
	header("Location: admin_book.php");
	exit();
}

$query = "SELECT email, password FROM customers WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
	if ($name == $row['email'] && $pass == $row['password']) {
		$_SESSION['user'] = true;
		$_SESSION['email'] = $name;
		unset($_SESSION['manager'], $_SESSION['expert']);
		header("Location: index.php");
		exit();
	}
}

header("Location: ../book_store_system/signin.php?signin=invalid");
exit();

if (isset($conn)) {
	mysqli_close($conn);
}
?>