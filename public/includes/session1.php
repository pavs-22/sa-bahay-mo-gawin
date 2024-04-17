<?php
	session_start();
	include 'conn.php';

	// if(!isset($_SESSION['admin']) || trim($_SESSION['admin']) == ''){
	// 	header('location: index.php');
	// }  

     if(isset($_GET['id'])){
     $s_id = $_GET['id'];

        $sql = "SELECT * FROM book31 WHERE id = $s_id";
        $result = mysqli_query($conn, $sql);

          while ($row = mysqli_fetch_array($result)){
              $id = $row['id'];
         }
     }


?>