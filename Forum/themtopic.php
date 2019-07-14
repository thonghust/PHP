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
<div style="width:1000px; height:700px; background:#ffc; margin:auto" align="center">
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
</center>
<center><img src="logo.jpg" width="850px" height="200px"><br>
<h1>» Trang tin tức hay nhất Việt Nam «</h1>
<font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold; font-size:20px">Thêm mới topic</font><br><br>
<table align="center" border="1" cellpadding="5" width="400px">
<tr align="center">
	<td><textarea rows="5" cols="40" name="nd"></textarea></td>
</tr>
<tr  align="center">
	<td><input type="submit" name="ok" value="Thêm mới topic">
    <input type="submit" name="home" value="Quay lại Trang chủ"></td>
</tr>
</table>
</div>
</form>
</body>
</html>
<?php
	$nd = $_POST['nd'];
	if(isset($_POST['ok']))
	{
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
?>