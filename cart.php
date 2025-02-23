<?php
session_start();
require_once "./functions/database_functions.php";
require_once "./functions/cart_functions.php";

$conn = db_connect();

// book_isbn got from form post method
if (isset($_POST['bookisbn'])) {
  $book_isbn = $_POST['bookisbn'];
}

if (isset($book_isbn)) {
  // new item selected
  if (!isset($_SESSION['cart'])) {
    // $_SESSION['cart'] is associative array that bookisbn => qty
    $_SESSION['cart'] = array();
    $_SESSION['total_items'] = 0;
    $_SESSION['total_price'] = '0.00';
    $_SESSION['total_price_with_delivery'] = 0;
  }

  if (!isset($_SESSION['cart'][$book_isbn])) {
    $_SESSION['cart'][$book_isbn] = 1;
  } elseif (isset($_POST['cart'])) {
    $_SESSION['cart'][$book_isbn]++;
    unset($_POST);
  }
}

// if save change button is clicked, change the qty of each bookisbn
if (isset($_POST['save_change'])) {
  foreach ($_SESSION['cart'] as $isbn => $qty) {
    if ($_POST[$isbn] == '0') {
      unset($_SESSION['cart']["$isbn"]);
    } else {
      $_SESSION['cart']["$isbn"] = $_POST["$isbn"];
    }
  }
}

// print out header here
$title = "Your Shopping Cart";
require "./template/header.php";
?>

<style>
  <?php include './CSS/cart.css'; ?>
</style>


<div class="cart-container">
  <h2 class="cart-title">Your Shopping Cart</h2>

  <?php
  if (isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))) {
    $_SESSION['total_price'] = total_price($_SESSION['cart']);
    $_SESSION['total_items'] = total_items($_SESSION['cart']);
    $_SESSION['total_price_with_delivery'] = $_SESSION['total_price'] + 20;
    ?>

    <form action="cart.php" method="post">
      <div class="card">
        <div class="card-header">Cart Items</div>
        <div class="card-body">
          <div class="table-container">
            <table class="cart-table">
              <thead>
                <tr>
                  <th>Item</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($_SESSION['cart'] as $isbn => $qty) {
                  $conn = db_connect();
                  $book = mysqli_fetch_assoc(getBookByIsbn($conn, $isbn));
                  ?>
                  <tr>
                    <td>
                      <div class="item-display">
                        <div class="item-details">
                          <h3><?php echo $book['book_title']; ?></h3>
                          <p>by <?php echo $book['book_author']; ?></p>
                        </div>
                      </div>
                    </td>
                    <td><?php echo "$" . number_format($book['book_price'], 2); ?></td>
                    <td style="position: relative;">
                      <input type="number" min="0" max=<?php echo $book['stock'] ?> value="<?php echo $qty; ?>"
                        class="quantity-input" name="<?php echo $isbn; ?>">
                      <br>
                      <span style="font-size: 14px; position: absolute;"> <?php echo $book['stock'] ?> available </span>
                    </td>
                    <td><strong><?php echo "$" . number_format($qty * $book['book_price'], 2); ?></strong></td>
                  </tr>
                <?php } ?>
              </tbody>
              <tfoot>
                <tr class="total-row">
                  <td colspan="2"></td>
                  <td>Total Items: <?php echo $_SESSION['total_items']; ?></td>
                  <td>Total: <?php echo "$" . number_format($_SESSION['total_price'], 2); ?></td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-success" name="save_change">
            Update Cart
          </button>
          <div>
            <a href="books.php" class="btn btn-secondary">
              Continue Shopping
            </a>
            <a href="checkout.php" class="btn btn-primary">
              Proceed to Checkout
            </a>
          </div>
        </div>
      </div>
    </form>

    <?php
  } else {
    ?>
    <div class="alert alert-warning">
      Your cart is empty! Please make sure you add some books to it.
      <div style="margin-top: 15px;">
        <a href="books.php" class="btn btn-primary">
          Browse Books
        </a>
      </div>
    </div>
    <?php
  }

  if (isset($_SESSION['user'])) {
    $customer = getCustomerIdbyEmail($_SESSION['email']);
    $customerid = $customer['id'];
    $query = "SELECT * FROM cart join cartitems join books join customers
          on customers.id='$customerid' and cart.customerid='$customerid' and cart.id=cartitems.cartid and cartitems.productid=books.book_isbn";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) != 0) {
      ?>
      <div class="card" style="margin-top: 30px;">
        <div class="card-header secondary-header">Your Purchase History</div>
        <div class="card-body">
          <div class="table-container">
            <table class="cart-table">
              <thead>
                <tr>
                  <th>Item</th>
                  <th>Quantity</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($query_row = mysqli_fetch_assoc($result)) {
                  ?>
                  <tr>
                    <td>
                      <div class="item-display">

                        <div class="item-details">
                          <h3><?php echo $query_row['book_title']; ?></h3>
                          <p>by <?php echo $query_row['book_author']; ?></p>
                        </div>
                      </div>
                    </td>
                    <td><?php echo $query_row['quantity']; ?></td>
                    <td><?php echo date('F j, Y', strtotime($query_row['date'])); ?></td>
                  </tr>
                  <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <?php
    }
  }
  ?>
</div>