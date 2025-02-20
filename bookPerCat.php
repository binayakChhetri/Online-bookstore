<style>
	<?php include './CSS/booksPerCat.css'; ?>
</style>

<?php
session_start();
require_once "./functions/database_functions.php";
// get pubid
if (isset($_GET['catid'])) {
	$catid = $_GET['catid'];
} else {
	echo "Wrong query! Check again!";
	exit;
}


// connect database
$conn = db_connect();
$catName = getCatName($conn, $catid);

$query = "SELECT book_isbn, book_title, book_image FROM books WHERE categoryid = '$catid'";
$result = mysqli_query($conn, $query);
if (!$result) {
	echo "Can't retrieve data " . mysqli_error($conn);
	exit;
}
if (mysqli_num_rows($result) == 0) {
	echo "Empty books ! Please wait until new books coming!";
	exit;
}

$title = "Books Per Category";
require "./template/header.php";
?>

<div class="book-per-cat">
	<h2 class="title"><a href="category_list.php">Categories</a> > <?php echo $catName; ?></h2>
	<?php while ($row = mysqli_fetch_assoc($result)) {
		?>
		<div class="book-detail">
			<div class="img-container">
				<img class="img-responsive img-thumbnail" src="./images/img/<?php echo $row['book_image']; ?>">
			</div>
			<div class="book-info">
				<h4><?php echo $row['book_title']; ?></h4>
				<a href="book.php?bookisbn=<?php echo $row['book_isbn']; ?>" class="btn btn-primary">Get Details</a>
			</div>
		</div>
		<br>
		<?php
	} ?>
</div>

<?php
if (isset($conn)) {
	mysqli_close($conn);
}
require "./template/footer.php";
?>