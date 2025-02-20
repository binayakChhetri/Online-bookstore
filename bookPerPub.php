<?php
// Start session and include necessary files
session_start();
require_once "./functions/database_functions.php";

// Validate GET parameter 'pubid'
if (!isset($_GET['pubid'])) {
	echo "Wrong query! Check again!";
	exit;
}

$pubid = $_GET['pubid'];

// Connect to the database and fetch publisher information
$conn = db_connect();
$pubName = getPubName($conn, $pubid);

// Query for books by publisher
$query = "SELECT book_isbn, book_title, book_image FROM books WHERE publisherid = '$pubid'";
$result = mysqli_query($conn, $query);

if (!$result) {
	echo "Can't retrieve data " . mysqli_error($conn);
	exit;
}

if (mysqli_num_rows($result) == 0) {
	echo "Empty books! Please wait until new books coming!";
	exit;
}

$title = "Books Per Publisher";
require "./template/header.php";
?>

<!-- Link CSS -->
<style>
	<?php include './CSS/bookPerPub.css'; ?>
</style>

<div class="book-per-pub">
	<h2 class="title">
		<a href="publisher_list.php">Publishers</a> > <?php echo $pubName; ?>
	</h2>
	<?php while ($row = mysqli_fetch_assoc($result)): ?>
		<div class="book-detail">
			<div class="img-container">
				<img class="img-responsive img-thumbnail" src="./images/img/<?php echo $row['book_image']; ?>"
					alt="<?php echo $row['book_title']; ?>">
			</div>
			<div class="book-info">
				<h4><?php echo $row['book_title']; ?></h4>
				<a href="book.php?bookisbn=<?php echo $row['book_isbn']; ?>" class="btn btn-primary">Get Details</a>
			</div>
		</div>
		<br>
	<?php endwhile; ?>
</div>

<?php
// Close database connection
if (isset($conn)) {
	mysqli_close($conn);
}
require "./template/footer.php";
?>