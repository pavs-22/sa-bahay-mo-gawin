<?php
	session_start();
	include 'conn.php';

	// if(!isset($_SESSION['admin']) || trim($_SESSION['admin']) == ''){
	// 	header('location: index.php');
	// }  

	$sql = "SELECT * FROM scholars WHERE stud_id = '".$_SESSION['stud_id']."'";
	$query = $conn->query($sql);
	$user = $query->fetch_assoc();


?>