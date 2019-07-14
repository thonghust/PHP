<?php
	require_once("connect.php");
	$id = $_REQUEST['xoa'];
	$q = mysqli_query($con, "delete from danhba where id = $id");
	if($q)
	{ 
		echo "<script>alert('Xóa thành công')</script>";
		header('location:danhba.php');
	}
	else echo "<script>alert('Xóa không thành công')</script>";
?>