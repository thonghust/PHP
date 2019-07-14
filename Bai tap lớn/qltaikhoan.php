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
<title>Quản lý tài khoản</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
<div style="width:1000px; height:650px; background:#ffc; margin:auto" align="center">
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
<font style="font-family:Tahoma, Geneva, sans-serif; font-style:italic; font-size:20px; padding-left:10px; font-weight:bold"><a href="home.php" style="color:#00F; text-decoration:none">Trang chủ</a> » <a href="#" style="color:#00F; text-decoration:none">Quản lý tài khoản</a><br>
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
<input type="submit" name="themtk" value="Thêm mới tài khoản">
<input type="submit" name="home" value="Quay lại trang chủ">
</font><br><br>
<?php
if($_SESSION['tk'] == "admin")
{ ?>
<table width="700px" align="center" cellpadding="5" border="1">
<tr align="center">
	<td width="270px"><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Danh sách tài khoản</font></td>
    <td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Mật khẩu</font></td>
    <td colspan="4" width="180px"><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Tùy chọn</font></td>
</tr>
<?php
	$ad = "admin";
	$q = mysqli_query($con, "select * from taikhoan where taikhoan != '$ad'");
	while($num = mysqli_fetch_array($q))
	{ ?>
<tr align="center">
	<td><font style="font-weight:bold; color:#00F"><?php echo $num['taikhoan']." "; ?></font>
    <?php
	if($num['block'] == "block") { ?>
    <font style="font-weight:bold; color:#F00; font-size:12px"><?php } ?>
    <?php
	if($num['block'] != "block") { ?>
    <font style="font-weight:bold; color:#390; font-size:12px"><?php } ?>
	<?php
	if($num['block'] == "block") echo "(Đã chặn)"; else echo "(Đang hoạt động)"; ?></font></td>
    <td style="font-weight:bold; color:#F00; font-size:14px"><?php echo $num['matkhau']; ?></td>
    <td><a style="text-decoration:none; font-weight:bold; color:#00F" href='xoatk.php?xoa="<?php echo $num['id'];?>"'>Xóa</a></td>
    <td><a style="text-decoration:none; font-weight:bold; color:#00F" href='suatk.php?sua="<?php echo $num['id'];?>"'>Sửa</a></td>
    <td><a style="text-decoration:none; font-weight:bold; color:#00F" href='chantk.php?chan="<?php echo $num['id'];?>"'>Chặn</a></td>
    <td><a style="text-decoration:none; font-weight:bold; color:#00F" href='bochantk.php?bochan="<?php echo $num['id'];?>"'>Bỏ chặn</a></td>
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
	if(isset($_POST['themtk']))
	{
		header('location:dangky.php');
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