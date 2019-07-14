<?php
	require_once("connect.php");
	require_once("ham.php");
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sửa bình luận</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
<div style="width:1000px; height:1000px; background:#ffc; margin:auto" align="center">
<font style="font-family:Tahoma, Geneva, sans-serif; font-style:italic; font-size:16px"><?php 
    
    if($_SESSION['tk'])
	{
		echo "Xin chào, " .$_SESSION['tk']. " ";
		echo "["." <a href=\"dangxuat.php\">Đăng xuất</a>"."]"; 
	}
	 else
	{ ?>
    Vui lòng đăng nhập/đăng ký để có thể nhận quyền user
    <input type="submit" name="dn" value="Đăng nhập">
	<input type="submit" name="dk" value="Đăng ký"> <?php } ?></font>
<center><img src="logo.jpg" width="850px" height="200px"></center><br>
<h1>» Trang tin tức hay nhất Việt Nam «</h1>
<font style="font-family:Tahoma, Geneva, sans-serif; font-style:italic; font-size:20px; padding-left:10px; font-weight:bold"><a href="home.php">Trang chủ</a> » <a href="home.php">Bài viết</a> » <a href="suabl.php">Sửa bình luận</a></font><br><br>
<input type="submit" name="tk2" value="Tìm kiếm bài viết"></font><br><br>
<?php
	$id = $_REQUEST['sua'];
	$q = mysqli_query($con, "select * from comment where id = $id");
	$num = mysqli_fetch_array($q);
?>
<table align="center" border="1" cellpadding="5" width="700px">
<tr align="center">
	<td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Bình luận</font></td>
</tr>
<tr align="center">
	<td><textarea name="cmt" rows="4" cols="60"><?php echo $num['comment']; ?></textarea></td>
</tr>
<tr align="center">
	<td><input type="submit" name="ok" value="Sửa bình luận"></td>
</tr>
</table>
</div>
</form>
</body>
</html>
<?php
	if(isset($_POST['ok']))
	{
		$cmt = $_POST['cmt'];
		if(empty($cmt))
		{
			echo "<script>alert('Nội dung không được để trống')</script>";
		}
		else
		{
			if($num['taikhoan'] != $_SESSION['tk'] && $_SESSION['tk'] != "admin")
			{
				echo "<script>alert('Bạn không thể sửa bình luận của người khác')</script>";
			}
			else
			{
				$sua = suabl($id, $cmt);
				header("location:baiviet.php?id=".$_SESSION['idbv']);
			}
		}
	}
	if(isset($_POST['tk2']))
	{
		header('location:timkiem.php');
	}
?>