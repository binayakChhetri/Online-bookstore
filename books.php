<style>
  <?php include './CSS/books.css'; ?>
</style>

<?php
session_start();
require_once "./functions/database_functions.php";
$conn = db_connect();

$query = "SELECT * FROM books";
if (isset($_POST['title']) || isset($_POST['price']) || isset($_POST['author'])) {
  $orderBy = '';
  $direction = 'asc';

  if (isset($_POST['desc'])) {
    $direction = 'desc';
  }

  if (isset($_POST['title'])) {
    $orderBy = 'book_title';
  } elseif (isset($_POST['price'])) {
    $orderBy = 'book_price';
  } elseif (isset($_POST['author'])) {
    $orderBy = 'book_author';
  }

  if ($orderBy) {
    $query .= " ORDER BY $orderBy $direction";
  }
}

$result = mysqli_query($conn, $query);
$title = "Full Catalogs of Books";
require_once "./template/header.php";
?>

<div class="books-form">
  <div class="header">
    <h2>Full Catalogs of Books</h2>
    <h5>Sort By:</h5>
  </div>
  <form method="post" action="books.php">
    <div class="sort-options">
      <div class="radio">
        <label>
          <input type="radio" name="sort_direction" value="asc" <?php echo (!isset($_POST['desc'])) ? 'checked' : ''; ?>>
          Ascending
        </label>
      </div>
      <div class="radio">
        <label>
          <input type="radio" name="sort_direction" value="desc" <?php echo (isset($_POST['desc'])) ? 'checked' : ''; ?>>
          Descending
        </label>
      </div>
    </div>

    <div class="button-group">
      <button type="submit" name="title">Title</button>
      <button type="submit" name="price">Price</button>
      <button type="submit" name="author">Author</button>
      <button type="submit">Clear</button>
    </div>
  </form>
</div>

<div class="books-container">
  <?php while ($book = mysqli_fetch_assoc($result)) { ?>
    <div class="book-card">
      <a href="book.php?bookisbn=<?php echo $book['book_isbn']; ?>">
        <img src="./images/img/<?php echo $book['book_image']; ?>" alt="<?php echo $book['book_title']; ?>">
      </a>
      <div class="book-details">
        <h3><?php echo $book['book_title']; ?></h3>
        <p class="author"><?php echo $book['book_author']; ?></p>
        <p class="price">$<?php echo number_format($book['book_price'], 2); ?></p>
        <p class="stock"> <?php echo $book['stock'] == "0" ? "Out of stock" : "In stock " . $book['stock'] ?> </p>
      </div>
    </div>
  <?php } ?>
</div>

<?php
if (isset($conn)) {
  mysqli_close($conn);
}
require_once "./template/footer.php";
?>