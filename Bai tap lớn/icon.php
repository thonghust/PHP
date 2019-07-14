<?php
	require_once("connect.php");
	require_once("ham.php");
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Biểu tượng cảm xúc</title>
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
<img src="logo.jpg" width="850px" height="200px"><br>
<h1 >» Trang tin tức hay nhất Việt Nam «</h1>
<font style="font-family:Tahoma, Geneva, sans-serif; font-style:italic; font-size:20px; padding-left:10px; font-weight:bold"><a href="home.php" style="color:#00F; text-decoration:none">Trang chủ</a> » <a href="#" style="color:#00F; text-decoration:none">Thêm icon cảm xúc</a><br>
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
<input type="submit" name="home" value="Quay lại trang chủ">
</font><br><br>
	<font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Chọn biểu tượng cảm xúc</font><br><br>
    <?php if($_SESSION['tk'] == "admin")
	{ ?>
<input type="submit" name="taoicon" value="Tạo một icon mới"><br><br> <?php } ?>
<?php
	$idbaiviet = $_SESSION['idbaiviet'];
	$dem = 0;
	$q = mysqli_query($con, "select * from icon");
	while($num = mysqli_fetch_array($q))
	{ 
	$dem = $dem + 1; ?>
<a href='luuicon.php?id="<?php echo $num['id']; ?>"'><?php echo $num['icon']; if($dem > 25) { ?><br></a><?php } $dem = 0; ?>
<?php } ?>
<br><br>
<input type="submit" name="back" value="Quay lại bình luận">
</div>
</form>
</body>
</html>
<?php 
	if(isset($_POST['tk']))
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
		header("location:baiviet.php?id=".$_SESSION['idbaiviet']);
	}
	if(isset($_POST['taoicon']))
	{
		header('location:themicon.php');
	}
?>