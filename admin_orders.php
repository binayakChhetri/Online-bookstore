<?php
session_start();

if ((!isset($_SESSION['manager']))) {
    header("Location:index.php");
}

?>
<style>
    <?php include "CSS/admin_orders.css" ?>
</style>
<?php

$title = "Orders";
require_once "./functions/database_functions.php";
$conn = db_connect();
$orders = getAllOrders($conn);
?>

<?php

function confirmOrders($order_id)
{
    ?>
    <script>
        alert($order_id);
    </script>
    <?php
}
?>

<div class="admin-order-nav">
    <a href="admin_signout.php" class="btn btn-danger"><span class="glyphicon glyphicon-off"></span>&nbsp;Logout</a>
    <a href="admin_book.php" class="btn btn-primary"><span class="glyphicon glyphicon-book"></span>&nbsp;Books</a>
    <a href="admin_publishers.php" class="btn btn-primary"><span
            class="glyphicon glyphicon-paperclip"></span>&nbsp;Publishers</a>
    <a href="admin_categories.php" class="btn btn-primary"><span
            class="glyphicon glyphicon-list-alt"></span>&nbsp;Categories</a>
    <?php
    if (isset($_SESSION['manager']) && $_SESSION['manager'] == true) {
        echo '<a class="btn btn-primary" href="admin_add.php"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Book</a>';
    }
    ?>
</div>
<div class="admin-order-dashboard">
    <div class="not-confirmed-orders">
        <h1> Orders</h1>
        <?php
        if (mysqli_num_rows($orders) != 0) {
            ?>
            <ul class="not-confirmed-orders-container">
                <?php
                while ($query_row = mysqli_fetch_assoc($orders)) {
                    $book_info = json_decode($query_row['book_info'], true);
                    ?>
                    <li>
                        <div class="order-detail">
                            <h3>Order ID:<?php echo $query_row['order_id'] ?> </h3>
                            <p>Customer ID: <?php echo $query_row['customer_id'] ?> </p>
                            <p>Order Date: <?php echo date("g:i A, M d, Y", strtotime($query_row['order_date'])) ?></p>
                            <p>Order Status: <?php echo ucfirst(strtolower($query_row['order_status'])); ?> </p>
                            <p>Total Quantity: <?php echo $query_row['quantity'] ?> </p>
                            <div class="product-detail">
                                <h4>Product Details</h4>
                                <?php
                                if (!empty($book_info)) {
                                    foreach ($book_info as $key => $value) {
                                        $books = getBookByIsbn($conn, $key);
                                        $book = mysqli_fetch_assoc($books);
                                        echo '<div class="book-title">' . $book['book_title'];
                                        if ($value > 1) {
                                            echo '<span class="quantity">' . $value . '</span>';
                                        }
                                        echo '</div>';
                                    }
                                } else {
                                    echo '<p class="no-products">No products in this order.</p>';
                                }
                                ?>
                            </div>
                            <?php if ($query_row['order_status'] === 'placed') {
                                ?>
                                <form method="post" action="confirm_order.php">
                                    <?php
                                    $_SESSION['book_info'] = $query_row['book_info'];
                                    ?>
                                    <input type="hidden" name="id" value="<?php echo $query_row['order_id'] ?>">
                                    <input type="submit" name="confirm" value="Confirm" class="confirm">
                                </form>
                                <form method="post" action="cancel_order.php">
                                    <input type="hidden" name="id" value="<?php echo $query_row['order_id'] ?>">
                                    <input type="submit" name="cancel" value="Cancel" class="confirm">
                                </form>
                                <?php
                            } ?>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <?php
        } else {
            ?>
            <p>No orders to confirm.</p>
            <?php
        }
        ?>
    </div>

    <script>
        setInterval(() => {
            fetch("update_order_status.php")
                .then(response => response.text())
                .then(data => console.log(data))
                .catch(error => console.error("Error:", error));
        }, 30000)
    </script>

</div>