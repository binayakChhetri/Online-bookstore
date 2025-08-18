<?php
session_start();
require_once 'functions/database_functions.php';
$conn = db_connect();

if (isset($_POST['cancel'])) {
    $order_id = $_POST['id'];

    function cancelOrder($conn, $order_id)
    {
        $query = "UPDATE orders SET order_status = 'Cancelled' WHERE order_id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $order_id);
        $result = mysqli_stmt_execute($stmt);

        if (!$result) {
            echo "Error updating order status: " . mysqli_error($conn);
            return false;
        }

        return true;
    }
    cancelOrder($conn, $order_id);

}

header("Location: admin_orders.php");

?>