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
<font style="color:#00F; font-weight:bold; font-size:16px; font-family:Tahoma, Geneva, sans-serif"><?php 
    if($_SESSION['tk'])
	{
		echo "Xin chào, " ?><font style="color:#F00; font-weight:bold; font-size:16px; font-family:Tahoma, Geneva, sans-serif"><?php echo $_SESSION['tk']. " "; ?></font>
     <font style="font-weight:bold; font-size:16px; font-family:Tahoma, Geneva, sans-serif; color:#60F">[</font><a href="dangxuat.php" style="color:#00F; text-decoration:none">Đăng xuất</a></font>
     <font style="font-weight:bold; font-size:16px; font-family:Tahoma, Geneva, sans-serif; color:#60F">]</font>
     <?php
	}
	 else
	{ ?>
    Vui lòng đăng nhập/đăng ký để có thể nhận quyền user
    <input type="submit" name="dn" value="Đăng nhập">
	<input type="submit" name="dk" value="Đăng ký"> <?php } ?></font>
<center><img src="img/banner3.jpg" width="1000px" height="200px"></center><br>
<h1 style="color:#FFF; font-weight:bold; font-size:26px; font-family:Tahoma, Geneva, sans-serif; background-color:#00F">» Trang tin tức hay nhất Việt Nam «</h1>
<font style="font-family:Tahoma, Geneva, sans-serif; font-style:italic; font-size:20px; padding-left:10px; font-weight:bold"><a href="home.php" style="text-decoration:none; color:#00F">Trang chủ</a> » <a href="#" style="text-decoration:none; color:#00F">Bài viết</a> » <a href="#" style="text-decoration:none; color:#00F">Sửa bình luận</a></font><br><br>
<table cellpadding="3">
<tr>
	<td><select name="sapxep">
    	<option>Sắp xếp theo</option>
    	<option>Theo ngày tạo</option>
        <option>Xem nhiều nhất</option>
        <option>Like nhiều nhất</option>
        <option>Heart nhiều nhất</option>
    </select></td>
    <?php
	if(isset($_POST['tk2']))
	{
		if($_POST['sapxep'] == "Xem nhiều nhất")
		{
			$_SESSION['sort'] = "xem";
		}
		if($_POST['sapxep'] == "Like nhiều nhất")
		{
			$_SESSION['sort'] = "like";
		}
		if($_POST['sapxep'] == "Heart nhiều nhất")
		{
			$_SESSION['sort'] = "heart";
		}
		if($_POST['sapxep'] == "Theo ngày tạo")
		{
			$_SESSION['sort'] = "ngaytao";
		}
		if($_POST['sapxep'] == "Sắp xếp theo")
		{
			$_SESSION['sort'] = "ngaytao";
		}
	}
	?>
	<td><input type="text" name="tim"></td>
    <td><img src="img/search.png" width="25px" height="25px"></td>
</tr>
</table>
<input type="submit" name="tk2" value="Tìm kiếm bài viết"></font><br><br>
<?php
	$id = $_REQUEST['sua'];
	$_SESSION['id_bl'] = $id;
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
	<td><input type="submit" name="ok" value="Sửa bình luận"><input type="submit" name="back" value="Quay lại"><input type="submit" name="home" value="Trang chủ"></td>
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
		$_SESSION['timkiem'] = $_POST['tim'];
		header('location:timkiem.php');
	}
	if(isset($_POST['home']))
	{
		header('location:home.php');
	}
	if(isset($_POST['back']))
	{
		header("location:baiviet.php?id=".$_SESSION['idbv']);
	}
	if(isset($_POST['themicon']))
	{
		header('location:icon.php');
	}
?>