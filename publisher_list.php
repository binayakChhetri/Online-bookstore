
<?php
    session_start();
    require_once "./functions/database_functions.php";
    $conn = db_connect();
    $query = "SELECT * FROM publisher ORDER BY publisherid";
    $result = mysqli_query($conn, $query);
    if(!$result){
        echo "Can't retrieve data " . mysqli_error($conn);
        exit;
    }
    if(mysqli_num_rows($result) == 0){
        echo "Empty publisher ! Something wrong! check again";
        exit;
    }

    $title = "List Of Publishers";
    require "./template/header.php";
?>
    <style>
      <?php include './CSS/publisher_list.css';?>
    </style>
   <div class="publisher-section">
		<h2 >List of Publisher</h2>
		<ul>
			<?php 
				while($row = mysqli_fetch_assoc($result)){
					$count = 0; 
					$query = "SELECT publisherid FROM books";
					$result2 = mysqli_query($conn, $query);
					if(!$result2){
						echo "Can't retrieve data " . mysqli_error($conn);
						exit;
					}
					while ($pubInBook = mysqli_fetch_assoc($result2)){
						if($pubInBook['publisherid'] == $row['publisherid']){
							$count++;
						}
					}
			?>
			<li >
				<a href="bookPerPub.php?pubid=<?php echo $row['publisherid']; ?>"><?php echo $row['publisher_name']; ?></a>
				<p class="badge"><?php echo $count; ?>  📘</p>
			</li>
		<?php } ?>
			<li>
				<a href="books.php">Click here to list full of books</a>
			</li>
		</ul>
   </div>

<?php
    mysqli_close($conn);
    require "./template/footer.php";
?>