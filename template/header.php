<?php
if (!isset($_SESSION)) {
  session_start();
}
require_once "./functions/database_functions.php";
if (isset($_SESSION['email'])) {
  $customer = getCustomerIdbyEmail($_SESSION['email']);
  $name = $customer['firstname'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $title; ?></title>
  <style>
    <?php include './CSS/header.css'; ?>
  </style>
</head>

<body>
  <nav class="navbar">
    <div class="container">
      <div class="navbar-header">
        <a class="store-name" href="index.php">RL Books</a>
        <form method="post" action="search_book.php">
          <input type="text" id="inputPassword2" placeholder="Search books" name="text">
          <button type="submit" style="display:none"></button>
        </form>
      </div>

      <div id="navbar">
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="publisher_list.php">
              Publishers
            </a>
          </li>

          <li><a href="category_list.php">Categories</a></li>

          <li><a href="books.php">Books</a></li>

          <li><a href="cart.php">My Cart</a></li>
          <li><a href="my_orders.php">My Orders</a></li>
          <?php
          if (isset($_SESSION['user'])) {
            echo ' <li><a href="logout.php">LogOut</a></li>' . '<li><a href="profile.php">'
              . $name .
              '</a></li>';
          } else {
            echo ' <li><a href="signin.php"> Sign in</a></li>' . '<li><a href="signup.php">Sign up</a></li>';
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>
  <?php
  if (isset($title) && $title == "Home") {
    ?>


    <section class="hero">
      <div class="hero-container">
        <div class="hero-content">
          <h1 class="hero-title">
            Discover Your Next
            <span>Great Read</span>
          </h1>

          <p class="hero-description">
            Explore a world of stories, from timeless classics to the latest bestsellers.
            Your literary journey begins here.
          </p>

          <form class="search-wrapper" method="post" action="search_book.php">
            <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
              fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="11" cy="11" r="8"></circle>
              <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input type="text" class="search-input" id="inputPassword2" placeholder="Search books" name="text">
            <button class="search-button" type="submit">Search</button>
          </form>

          <div class="hero-actions">
            <a href="./books.php" class="btn btn-primary">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
              </svg>
              Browse Books
            </a>
            <a href="cart.php" class="btn btn-outline">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="9" cy="21" r="1"></circle>
                <circle cx="20" cy="21" r="1"></circle>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
              </svg>
              View Cart
            </a>
          </div>
        </div>
      </div>
    </section>
    <?php
  }
  ?>