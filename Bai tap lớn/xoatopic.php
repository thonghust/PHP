<?php
	require_once("connect.php");
	require_once("ham.php");
	session_start();
	$id = $_REQUEST['xoa'];
	if($_SESSION['tk'] != "admin")
	{
		echo "<script>alert('Bạn không thể xóa Topic, chỉ người quản trị mới có quyền này')</script>";
	}
	else
	{
		$q = mysqli_query($con, "delete from topic where id = $id");
		if($q)
		{
			header('location:qltopic.php');
		}
	}
?>