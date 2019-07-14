<?php
	require_once("connect.php");
	require_once("ham.php");
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Đông y</title>
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
<img src="logo.jpg" width="850px" height="200px"><br>
<h1>» Trang tin tức hay nhất Việt Nam «</h1>
<font style="font-family:Tahoma, Geneva, sans-serif; font-style:italic; font-size:20px; padding-left:10px; font-weight:bold"><a href="home.php">Trang chủ</a> » <a href="home.php">Bài viết</a></font><br><br>
<input type="submit" name="themcd" value="Thêm bài viết">
<input type="submit" name="tk" value="Tìm kiếm bài viết"><input type="submit" name="xoa" value="Xóa tất cả bài viết"></font><br><br>
<table align="center" border="1" cellpadding="5" width="700px">
<tr align="center">
	<td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Ảnh</font></td>
	<td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Tên bài viết</font></td>
	<td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Nội dung bài viết</font></td>
    <td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Topic</font></td>
    <td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Người tạo</font></td>
    <td colspan="2"><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Tùy chọn</font></td>
</tr>
<?php
	$ID=$_GET['id'];
	$q = mysqli_query($con, "select * from timkiem where idtopic = '$ID'");
	while($num = mysqli_fetch_array($q))
	{ ?>
<tr align="center">
	<td><img width="100px" height="100px" src="img/<?php echo $num['anh']; ?>"></td>
	<td><a href="baiviet.php?id=<?php echo $num['id'];?>"><?php echo $num['tenbaiviet']; ?></a></td>
    <td><a href="baiviet.php?id=<?php echo $num['id'];?>"><?php echo $num['noidung']; ?></a></td>
    <td><?php echo $num['topic']; ?></td>
    <td><?php echo $num['nguoitao']; ?></td>
    <td width="50px"><font style=" padding-right:1px; font-size:14px"><a style="text-decoration:none; font-weight:bold" href='xoabai.php?xoa="<?php echo $num['id'];?>"'>Xóa</a></font></td>
    <td width="50px"><font style=" padding-right:1px; font-size:14px"><a style="text-decoration:none; font-weight:bold" href='suabai.php?sua="<?php echo $num['id'];?>"'>Sửa</a></font></td>
</tr>
<?php } ?>
</table>
</div>
</form>
</body>
</html>
<?php 
	if(isset($_POST['dn']))
	{
		header('location:dangnhap.php');
	}
	if(isset($_POST['dk']))
	{
		header('location:dangky.php');
	}
	if(isset($_POST['tk']))
	{
		header('location:timkiem.php');
	}
	if(isset($_POST['themcd']))
	{
		header('location:thembai.php');
	}
	if(isset($_POST['xoa']))
	 {
		 $m = mysqli_query($con, "delete from timkiem");
		 header('location:dongy.php');
	 }
?>