<style>
	<?php include './CSS/admin_book.css'; ?>
</style>
<?php
session_start();
if ((!isset($_SESSION['manager']) && !isset($_SESSION['expert']))) {
	header("Location:index.php");
}
$title = "List book";
require_once "./functions/database_functions.php";
$conn = db_connect();
$result = getAll($conn);
?>
<div class="admin-book-container">
	<div class="admin-btns">
		<a href="admin_signout.php" class="admin-btn logout-btn">
			<span class="glyphicon glyphicon-off"></span>
			<span class="btn-text">Logout</span>
		</a>
		<a href="admin_publishers.php" class="admin-btn">
			<span class="glyphicon glyphicon-paperclip"></span>
			<span class="btn-text">Publishers</span>
		</a>
		<a href="admin_categories.php" class="admin-btn">
			<span class="glyphicon glyphicon-list-alt"></span>
			<span class="btn-text">Categories</span>
		</a>
		<a href="admin_orders.php" class="admin-btn">
			<span class="glyphicon glyphicon-list-alt"></span>
			<span class="btn-text">Orders</span>
		</a>
		<?php
		if (isset($_SESSION['manager']) && $_SESSION['manager'] == true) {
			echo '<a class="admin-btn" href="admin_add.php">
                <span class="glyphicon glyphicon-plus"></span>
                <span class="btn-text">Add Book</span>
              </a>';
		}
		?>
	</div>

	<div class="table-responsive">
		<table class="admin-book">
			<tr>
				<th>ISBN</th>
				<th>Title</th>
				<th>Author</th>
				<th>Image</th>
				<th>Description</th>
				<th>Price ($)</th>
				<th>Publisher</th>
				<th>Category</th>
				<th>Stock</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
			</tr>
			<?php while ($row = mysqli_fetch_assoc($result)) { ?>
				<tr>
					<td><?php echo $row['book_isbn']; ?></td>
					<td class="title"><?php echo $row['book_title']; ?></td>
					<td><?php echo $row['book_author']; ?></td>
					<td class="image-cell">
						<img class="book-image" src="./images/img/<?php echo $row['book_image']; ?>" alt="Book cover">
					</td>
					<td class="description"><?php echo $row['book_descr']; ?></td>
					<td class="price"><?php echo $row['book_price']; ?></td>
					<td><?php echo getPubName($conn, $row['publisherid']); ?></td>
					<td><?php echo getCatName($conn, $row['categoryid']); ?></td>
					<td><?php echo $row['stock'] ?></td>
					<?php
					if (isset($_SESSION['manager']) && $_SESSION['manager'] == true) {
						echo '<td><a href="admin_edit.php?bookisbn=' . $row['book_isbn'] . '" class="action-btn edit-btn">
                            <span class="glyphicon glyphicon-pencil"></span> Edit
                          </a></td>';
						echo '<td><a href="admin_delete.php?bookisbn=' . $row['book_isbn'] . '" class="action-btn delete-btn">
                            <span class="glyphicon glyphicon-trash"></span> Delete
                          </a></td>';
					}
					?>
				</tr>
			<?php } ?>
		</table>
	</div>
</div>
<?php
if (isset($conn)) {
	mysqli_close($conn);
}
?>