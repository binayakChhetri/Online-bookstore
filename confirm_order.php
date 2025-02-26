<?php
session_start();
require_once 'functions/database_functions.php';
$conn = db_connect();

if (isset($_POST['confirm'])) {

    // This is the order id
    $order_id = $_POST['id'];
    //This holds the book info i.e its isbn num as key and quantity as value in json format
    $books = $_SESSION['book_info'];
    $book_info = json_decode($books, true);
    changeOrderStatus($conn, $order_id);
    function decreaseStockQuantity($conn, $order_id)
    {
        $query = "SELECT book_info FROM orders WHERE order_id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $order_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        if (!$row) {
            echo "Order not found!";
            return false;
        }
        $books = json_decode($row['book_info'], true);
        var_dump($books);
        foreach ($books as $key => $value) {
            $updateQuery = "UPDATE books SET stock = stock - ? WHERE book_isbn = ?";
            $stmt = mysqli_prepare($conn, $updateQuery);
            mysqli_stmt_bind_param($stmt, "is", $value, $key);
            mysqli_stmt_execute($stmt);
        }
        return true;
    }
    decreaseStockQuantity($conn, $order_id);
    header("Location: admin_orders.php");
}
?>