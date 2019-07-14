<?php
	require_once("connect.php");
	require_once("ham.php");
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Trang chủ</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
<div style="width:1000px; height:900px; background:#ffc; margin:auto" align="center">
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
<img src="logo.jpg" width="850px" height="200px"><br>
<h1>» Trang tin tức hay nhất Việt Nam «</h1>
<input type="submit" name="themtopic" value="Thêm mới topic">
<input type="submit" name="home" value="Quay lại trang chủ">
</font><br><br>
<table width="500px" align="center" cellpadding="5" border="1">
<tr align="center">
	<td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Danh sách Topic</font></td>
    <td colspan="2"><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Tùy chọn</font></td>
</tr>
<?php
	$q = mysqli_query($con, "select * from topic");
	while($num = mysqli_fetch_array($q))
	{ ?>
<tr align="center">
	<td style="font-weight:bold; color:#00F"><?php echo $num['topic']; ?></td>
    <td><a style="text-decoration:none; font-weight:bold" href='xoatopic.php?xoa="<?php echo $num['id'];?>"'>Xóa</a></font></td>
    <td><a style="text-decoration:none; font-weight:bold" href='suatopic.php?sua="<?php echo $num['id'];?>"'>Sửa</a></font></td>
</tr>
<?php } ?>
</table>
</div>
</form>
</body>
</html>
<?php 
	if(isset($_POST['themtopic']))
	{
		header('location:themtopic.php');
	}
	if(isset($_POST['home']))
	{
		header('location:home.php');
	}
?>