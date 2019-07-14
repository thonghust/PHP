<?php
	require_once("connect.php");
	require_once("ham.php");
	session_start();
	$id = $_REQUEST['id'];
	$q = mysqli_query($con, "select * from icon where id = $id");
	$num = mysqli_fetch_array($q);
	$_SESSION['icon'] = $num['icon'];
	header("location:baiviet.php?id=".$_SESSION['idbaiviet']);
?>