<?php
  session_start();
  $count = 0;
  // connect to database
  
  $title = "Home";
  require_once "./template/header.php";
  require_once "./functions/database_functions.php";
  $conn = db_connect();
  $row = select4LatestBook($conn);

?> 

      <h2 >EXPLORE OUR BOOKS</h2>
    
      <div class="book-explore">`
        <?php foreach($row as $book) { ?>
            <div class="book">
              <a  href="book.php?bookisbn=<?php echo $book['book_isbn']; ?>">
                <img class="img-responsive img-thumbnail" style="width:100%" src="./images/img/<?php echo $book['book_image']; ?>">
              </a>
              <p class="author">By <?php echo $book['book_author'] ?></p>
              <p class="title"><?php echo $book['book_title'] ?></p>
              <p class="price">$<?php echo $book['book_price'] ?></p>
            </div>
          <?php } ?>
      </div>
    
<?php
  if(isset($conn)) {mysqli_close($conn);}
  require_once "./template/footer.php";
?>