<?php
	require_once("connect.php");
	require_once("ham.php");
	session_start();
	$id = $_REQUEST['chan'];
	$q = mysqli_query($con, "select * from taikhoan where id = $id");
	$num = mysqli_fetch_array($q);
	$block = "block";
	$k = mysqli_query($con, "update taikhoan set block = '$block' where id = $id");
	echo "<script>alert('Đã chặn thành công')</script>";
	header('location:qltaikhoan.php');
?>