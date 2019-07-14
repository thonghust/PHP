<?php
	require_once("connect.php");
	require_once("ham.php");
	session_start();
	$id = $_REQUEST['xoa'];
	if($_SESSION['tk'] != "admin")
	{
		echo "<script>alert('Bạn không thể xóa tài khoản, chỉ người quản trị mới có quyền này')</script>";
	}
	else
	{
		$q = mysqli_query($con, "delete from taikhoan where id = $id");
		if($q)
		{
			header('location:qltaikhoan.php');
		}
	}
?>