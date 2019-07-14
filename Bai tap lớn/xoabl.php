<?php
	require_once("connect.php");
	require_once("ham.php");
	session_start();
	$id = $_REQUEST['xoa'];
	$k = mysqli_query($con, "Select * from comment where id = $id");
	$num = mysqli_fetch_array($k);
	echo "Bình luận này là của: ".$num['taikhoan'];
	if($num['taikhoan'] != $_SESSION['tk'] && $_SESSION['tk'] != "admin")
	{
		echo "<script>alert('Bạn không thể xóa bình luận của người khác, ấn back để quay lại')</script>";
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