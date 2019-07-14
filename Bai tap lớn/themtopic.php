<?php
	require_once("connect.php");
	require_once("ham.php");
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Đăng ký</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
<div style="width:1000px; height:710px; background:#ffc; margin:auto" align="center">
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
</center>
<center><img src="img/banner3.jpg" width="1000px" height="200px"><br>
<h1 style="color:#FFF; font-weight:bold; font-size:26px; font-family:Tahoma, Geneva, sans-serif; background-color:#00F">» Trang tin tức hay nhất Việt Nam «</h1>
<font style="font-family:Tahoma, Geneva, sans-serif; font-style:italic; font-size:20px; padding-left:10px; font-weight:bold"><a href="home.php" style="color:#00F; text-decoration:none">Trang chủ</a> » <a href="#" style="color:#00F; text-decoration:none">Thêm mới chủ đề</a></font><br><br>
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
<table align="center" border="1" cellpadding="5" width="400px">
<tr align="center">
	<td><textarea rows="5" cols="40" name="noidung"></textarea></td>
</tr>
<tr  align="center">
	<td><input type="submit" name="ok" value="Thêm mới chủ đề">
    <input type="submit" name="home" value="Quay lại Trang chủ"></td>
</tr>
</table>
</div>
</form>
</body>
</html>
<?php	
	if(isset($_POST['ok']))
	{
		$nd = $_POST['noidung'];
		if(empty($nd))
		{
			echo "<script>alert('Nội dung không được để trống')</script>";
		}
		else if($_SESSION['tk'] != "admin")
		{
			echo "<script>alert('Chỉ người quản trị trang web mới có quyền thêm mới topic, hãy đăng nhập với tài khoản có quyền quản trị admin')</script>";
		}
		else
		{
			$them = themtopic($nd);
			header('location:qltopic.php');
		}
	}
	if(isset($_POST['home']))
	{
		header('location:home.php');
	}
	if(isset($_POST['tk2']))
	{
		$_SESSION['timkiem'] = $_POST['tim'];
		header('location:timkiem.php');
	}
?>