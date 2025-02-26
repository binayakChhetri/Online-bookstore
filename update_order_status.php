<?php
require_once 'functions/database_functions.php';
$conn = db_connect();


if (!function_exists("markOrderAsDelivered")) {
    function markOrderAsDelivered($conn)
    {
        $query = "UPDATE orders SET order_status = 'Delivered' WHERE order_status = 'Confirmed'";
        $stmt = mysqli_prepare($conn, $query);

        // Since there are no parameters to bind, we don't need this line:
        // mysqli_stmt_bind_param($stmt, "s");

        $result = mysqli_stmt_execute($stmt);

        if (!$result) {
            echo "Error updating order status: " . mysqli_error($conn);
            return false;
        }

        if (mysqli_stmt_affected_rows($stmt) === 0) {
            echo "Order is not in 'Confirmed' status or does not exist.";
            return false;
        }

        return true;
    }
}

markOrderAsDelivered($conn);

?>