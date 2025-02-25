<?php
session_start();
require_once 'functions/database_functions.php';
$conn = db_connect();

if (isset($_POST['cancel'])) {
    $book_id = $_POST['id'];
    echo $book_id;



}


?>