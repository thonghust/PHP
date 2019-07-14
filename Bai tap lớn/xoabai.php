<?php
	require_once("connect.php");
	session_start();
	$id = $_REQUEST['xoa'];
	if($_SESSION['tk'] != "admin")
	{
		echo "<script>alert('Bạn không thể xóa bài viết, chỉ người quản trị mới có quyền này')</script>";
	}
	else
	{
		$q = mysqli_query($con, "delete from timkiem where id = $id");
		if($q)
		{ 
			header('location:home.php');
		}
	}
?>