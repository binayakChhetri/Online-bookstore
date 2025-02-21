<?php
session_start();
if ((!isset($_SESSION['manager']) && !isset($_SESSION['expert']))) {
	header("Location:index.php");
}
$title = "Add new book";
// require "./template/header.php";
require "./functions/database_functions.php";
$conn = db_connect();


if (isset($_GET["isbn"]) && $_GET["isbn"] === "already_exists") {
	echo "<div style='background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; text-align: center;'>
			ISBN is already exist. Please use another ISBN.
		  </div>";

	echo "
<script>
  setTimeout(function () {
    window.history.replaceState(null, '', window.location.pathname);
  }, 3000);
</script>";

}
?>

<?php
// Handle if ISBN already exists
if (isset(($_POST['add']))) {
	$isbn = trim($_POST['isbn']);

	$sameBook = "SELECT * FROM books WHERE book_isbn = '$isbn'";
	$sameResult = mysqli_query($conn, $sameBook);

	if (mysqli_num_rows($sameResult) > 0) {
		header("Location: admin_add.php?isbn=already_exists");
		exit();
	}
}

if (isset($_POST['add'])) {
	$isbn = trim($_POST['isbn']);
	$isbn = mysqli_real_escape_string($conn, $isbn);

	$title = trim($_POST['title']);
	$title = mysqli_real_escape_string($conn, $title);

	$author = trim($_POST['author']);
	$author = mysqli_real_escape_string($conn, $author);

	$descr = trim($_POST['descr']);
	$descr = mysqli_real_escape_string($conn, $descr);

	$price = floatval(trim($_POST['price']));
	$price = mysqli_real_escape_string($conn, $price);

	$publisher = trim($_POST['publisher']);
	$publisher = mysqli_real_escape_string($conn, $publisher);

	$category = trim($_POST['category']);
	$category = mysqli_real_escape_string($conn, $category);


	if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
		$image = $_FILES['image']['name'];
		$ext = pathinfo($image, PATHINFO_EXTENSION);

		$uniqueName = time() . "_" . uniqid() . "." . $ext;

		$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
		$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "images/img/";


		$uploadPath = $uploadDirectory . $uniqueName;

		if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
			echo "File uploaded successfully: " . $uniqueName;

			$title = $_POST['title'];
			$author = $_POST['author'];


			$query = "INSERT INTO books (book_title, book_author, book_image) VALUES (?, ?, ?)";
			$stmt = $conn->prepare($query);
			$stmt->bind_param("sss", $title, $author, $uniqueName); // Store the unique file name
			if ($stmt->execute()) {
				echo "Data inserted successfully!";
			} else {
				echo "Error inserting data: " . $stmt->error;
			}
			$stmt->close();
		} else {
			echo "File upload failed.";
		}
	}



	$findPub = "SELECT * FROM publisher WHERE publisher_name = '$publisher'";
	$findResult = mysqli_query($conn, $findPub);
	if (mysqli_num_rows($findResult) == 0) {
		// insert into publisher table and return id
		$insertPub = "INSERT INTO publisher(publisher_name) VALUES ('$publisher')";
		$insertResult = mysqli_query($conn, $insertPub);
		if (!$insertResult) {
			echo "Can't add new publisher " . mysqli_error($conn);
			exit;
		}
		$publisherid = mysqli_insert_id($conn);
	} else {
		$row = mysqli_fetch_assoc($findResult);
		$publisherid = $row['publisherid'];
	}

	$findCat = "SELECT * FROM category WHERE category_name = '$category'";
	$findResult = mysqli_query($conn, $findCat);
	if (mysqli_num_rows($findResult) == 0) {
		// insert into category table and return id
		$insertCat = "INSERT INTO category(category_name) VALUES ('$category')";
		$insertResult = mysqli_query($conn, $insertCat);
		if (!$insertResult) {
			echo "Can't add new category " . mysqli_error($conn);
			exit;
		}
		$categoryid = mysqli_insert_id($conn);
	} else {

		$row = mysqli_fetch_assoc($findResult);
		var_dump($row);
		$categoryid = $row['categoryid'];
	}


	$query = "INSERT INTO books VALUES ('" . $isbn . "', '" . $title . "', '" . $author . "', '" . $image . "', '" . $descr
		. "', '" . $price . "', '" . $publisherid . "', '" . $categoryid . "')";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		echo "Can't add new data " . mysqli_error($conn);
		exit();
	} else {
		header("Location: admin_book.php");
		exit();
	}
}
?>
<form method="post" action="admin_add.php" enctype="multipart/form-data">
	<table class="table">
		<tr>
			<th>ISBN</th>
			<td><input type="text" name="isbn"></td>
		</tr>
		<tr>
			<th>Title</th>
			<td><input type="text" name="title" required></td>
		</tr>
		<tr>
			<th>Author</th>
			<td><input type="text" name="author" required></td>
		</tr>
		<tr>
			<th>Image</th>
			<td><input type="file" name="image"></td>
		</tr>
		<tr>
			<th>Description</th>
			<td><textarea name="descr" cols="40" rows="5"></textarea></td>
		</tr>
		<tr>
			<th>Price</th>
			<td><input type="text" name="price" required></td>
		</tr>
		<tr>
			<th>Publisher</th>
			<td><input type="text" name="publisher" required></td>
		</tr>
		<tr>
			<th>Category</th>
			<td><input type="text" name="category" required></td>
		</tr>
	</table>
	<input type="submit" name="add" value="Add new book" class="btn btn-primary">
	<input type="reset" value="cancel" class="btn btn-default">
</form>
<br />

<?php
if (isset($conn)) {
	mysqli_close($conn);
}
?>