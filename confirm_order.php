<?php
session_start();
require_once 'functions/database_functions.php';
$conn = db_connect();

if (isset($_POST['confirm'])) {
    $book_id = $_POST['id'];


    changeOrderStatus($conn, $book_id);
    $books = $_SESSION['book_info'];
    $book_info = json_decode($books, true);

    foreach ($book_info as $key => $value) {
        decreaseStockQuantity($conn, $book_id, $key);
    }
    // header("Location: admin_orders.php");
}
?>