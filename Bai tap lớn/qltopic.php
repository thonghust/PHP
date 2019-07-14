<?php
	ob_start();
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
<img src="img/banner3.jpg" width="1000px" height="200px"><br>
<h1 style="color:#FFF; font-weight:bold; font-size:26px; font-family:Tahoma, Geneva, sans-serif; background-color:#00F">» Trang tin tức hay nhất Việt Nam «</h1>
<font style="font-family:Tahoma, Geneva, sans-serif; font-style:italic; font-size:20px; padding-left:10px; font-weight:bold"><a href="home.php" style="color:#00F; text-decoration:none">Trang chủ</a> » <a href="#" style="color:#00F; text-decoration:none">Quản lý chủ đề</a><br>
<?php
if($_SESSION['tk'] == "admin")
{ ?>
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
	if(isset($_POST['tk']))
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
<input type="submit" name="tk" value="Tìm kiếm bài viết">
<input type="submit" name="themtopic" value="Thêm mới chủ đề">
<input type="submit" name="home" value="Quay lại trang chủ">
</font><br><br>
<table width="650px" align="center" cellpadding="5" border="1">
<tr align="center">
	<td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Danh sách chủ đề</font></td>
    <td width="90px"><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Số bài viết</font></td>
    <td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Thêm mới bài viết</font></td>
    <td colspan="2" width="100px"><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Tùy chọn</font></td>
</tr>
<?php
	$q = mysqli_query($con, "select * from topic");
	while($num = mysqli_fetch_array($q))
	{ ?>
<tr align="center">
	<td style="font-weight:bold; color:#00F"><a href="dongy.php?id=<?php echo $num['id']; ?>" style="color:#00F; text-decoration:none"><?php echo $num['topic']; ?></a></td>
<td>
    <font style="font-weight:bold; color:#0F0"><?php 
	$layid = $num['id'];
	$dembaiviet = dembai($layid);
	?></font>
	</font></td>
    <td><a style="text-decoration:none; font-weight:bold; color:#F00; font-size:14px" href="thembai.php">Thêm mới</a></font></td>
    <td><a style="text-decoration:none; font-weight:bold; color:#00F" href='xoatopic.php?xoa="<?php echo $num['id'];?>"'>Xóa</a></font></td>
    <td><a style="text-decoration:none; font-weight:bold; color:#00F" href='suatopic.php?sua="<?php echo $num['id'];?>"'>Sửa</a></font></td>
</tr>
<?php } ?>
</table>
<?php }
else
{ ?>
<p style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Không có gì để hiển thị (Error: 404 NOT FOUND)</p><?php } ?>
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
	if(isset($_POST['tk']))
	 {
		$_SESSION['timkiem'] = $_POST['tim'];
		header('location:timkiem.php');
	 }
	ob_end_flush();
?>