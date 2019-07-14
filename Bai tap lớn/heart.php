<?php 
	require_once("connect.php");
	require_once("ham.php");
	session_start();
	$ID = $_REQUEST['id'];
	$q = mysqli_query($con, "select * from timkiem where id = $ID");
	$num = mysqli_fetch_array($q);
	$heart = $num['thatim'];
	$heart = $heart + 1;
	$k = mysqli_query($con, "update timkiem set thatim = '$heart' where id = $ID");
	header("location:baiviet.php?id=".$ID);
?>