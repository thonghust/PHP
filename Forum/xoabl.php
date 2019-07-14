<?php
	require_once("connect.php");
	require_once("ham.php");
	session_start();
	$id = $_REQUEST['xoa'];
	if($_SESSION['tk'] != "admin")
	{
		echo "<script>alert('Bạn không thể xóa bình luận, chỉ người quản trị mới có quyền này')</script>";
	}
	else
	{
		$q = mysqli_query($con, "delete from comment where id = $id");
		if($q)
		{
			header("location:baiviet.php?id=".$_SESSION['id']);
		}
	}
?>