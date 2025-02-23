<?php

session_start();
if ((!isset($_SESSION['manager']))) {
    header("Location:index.php");
}
$title = "Orders";
require_once "./functions/database_functions.php";
$conn = db_connect();
$result = getAllOrders($conn);
?>