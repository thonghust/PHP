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
<div style="width:1000px; height:1500px; background:#ffc; margin:auto" align="center">
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
<h1 style="color:#FFF; font-weight:bold; font-size:26px; font-family:Tahoma, Geneva, sans-serif; background-color:#00F">» Trang tin tức hay nhất Việt Nam «</h1>
<input type="submit" name="themcd" value="Thêm tin tức">
<input type="submit" name="ok" value="Tìm kiếm tin tức">
<input type="submit" name="qltopic" value="Quản lý chủ đề">
</font><br><br>
<?php
	
	$q2 = mysqli_query($con, "select * from topic");
?>
<table align="center" border="1" cellpadding="5" width="700px">
<?php 
	while($num2 = mysqli_fetch_array($q2))
	{ ?>
<tr>
	<td><a href="dongy.php?id=<?php echo $num2['id']; ?>"><b><span style="color:#FFF; font-weight:bold; font-size:22px; font-family:Tahoma, Geneva, sans-serif; background-color:#00F"><?php echo $num2['topic']; ?></span></b></a><br>
    <?php 
	$cc = $num2['id'];
	$q1 = mysqli_query($con, "select * from timkiem where idtopic = '$cc'");
	while($num1 = mysqli_fetch_array($q1))
	{ ?>
    <img style="float:left" width="100px" height="100px" src="img/<?php echo $num1['anh'];?> "><a href="baiviet.php?id=<?php echo $num1['id']; ?>"><font style="color:#00F; font-weight:bold; font-size:16px; font-family:Tahoma, Geneva, sans-serif"><?php if(empty($num1['tenbaiviet'])) { echo "Chưa có bài viết nào trong chủ đề này"; } else { echo $num1['tenbaiviet']; } ?></font></a><br><?php $noidung = substr( $num1['noidung'],0,500); echo $noidung; ?><div style="clear:both"><?php } ?></div></td>
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
	if(isset($_POST['ok']))
	{
		header('location:timkiem.php');
	}
	if(isset($_POST['themcd']))
	{
		header('location:thembai.php');
	}
	if(isset($_POST['qltopic']))
	{
		header('location:qltopic.php');
	}
ob_end_flush(); ?>