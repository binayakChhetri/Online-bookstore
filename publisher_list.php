<?php
	session_start();
	require_once "./functions/database_functions.php";
	$conn = db_connect();

	// Single optimized query to fetch publishers with book count
	$query = "
		SELECT p.publisherid, p.publisher_name, COUNT(b.bookid) AS book_count 
		FROM publisher p 
		LEFT JOIN books b ON p.publisherid = b.publisherid 
		GROUP BY p.publisherid, p.publisher_name 
		ORDER BY p.publisherid";
		
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Can't retrieve data " . mysqli_error($conn);
		exit;
	}

	if(mysqli_num_rows($result) == 0){
		echo "No publishers found!";
		exit;
	}

	$title = "List Of Publishers";
	require "./template/header.php";
?>
	<p class="lead">List of Publishers</p>
	<ul>
		<?php while($row = mysqli_fetch_assoc($result)): ?>
			<li>
				<span class="badge"><?php echo $row['book_count']; ?></span>
				<a href="bookPerPub.php?pubid=<?php echo $row['publisherid']; ?>"><?php echo $row['publisher_name']; ?></a>
			</li>
		<?php endwhile; ?>
			<li>
				<a href="books.php">List full of books</a>
			</li>
	</ul>

<?php
	mysqli_close($conn);
	require "./template/footer.php";
?>
