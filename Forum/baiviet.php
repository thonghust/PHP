<?php
	require_once("connect.php");
	require_once("ham.php");
	session_start();
	
	?>	
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Bài viết</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
<div style="width:1000px; height:1000px; background:#ffc; margin:auto">
<center><font style="font-family:Tahoma, Geneva, sans-serif; font-style:italic; font-size:16px"><?php 
    
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
<center><img src="logo.jpg" width="850px" height="200px"></center><br>
<h1 align="center">» Trang tin tức hay nhất Việt Nam «</h1>
<center><font style="font-family:Tahoma, Geneva, sans-serif; font-style:italic; font-size:20px; padding-left:10px; font-weight:bold"><a href="home.php">Trang chủ</a> » <a href="home.php">Bài viết</a> » <a href="baiviet.php?id=<?php echo $num['id']; ?>">Chi tiết</a></font></center><br><br>
<center><input type="submit" name="themcd" value="Thêm bài viết"><input type="submit" name="tk" value="Tìm kiếm bài viết"></font></center><br><br>

<table align="center" border="1" cellpadding="5" width="700px">
<tr align="center">
	<td>Ảnh</td>
	<td>Tên bài viết</td>
    <td>Nội dung bài viết</td>
    <td>Topic</td>
    <td>Người tạo</td>
    <td colspan="2">Tùy chọn</td>
</tr>
<tr>
    <td><?php
	$ID=$_GET['id'];
	$_SESSION['idbv'] = $ID;
	$_SESSION['id'] = $ID;
	$x = mysqli_query($con, "select * from timkiem where id = '$ID'");
	$y = mysqli_fetch_array($x); ?>
    <img width="100px" height="100px" src="img/<?php echo $y['anh']; ?> ">
	<td><?php echo $y['tenbaiviet']; ?></td>
    <td><?php echo $y['noidung']; ?></td>
    <td><?php echo $y['topic']; ?></td>
    <td><?php echo $y['nguoitao']; ?></td>
    <td width="50px" align="center"><font style=" padding-right:1px; font-size:14px"><a style="text-decoration:none; font-weight:bold" href='xoabai.php?xoa="<?php echo $y['id'];?>"'>Xóa</a></font></td>
    <td width="50px" align="center"><font style=" padding-right:1px; font-size:14px"><a style="text-decoration:none; font-weight:bold" href='suabai.php?sua="<?php echo $y['id'];?>"'>Sửa</a></font></td>
    
</tr>
</table>
<div style="margin-left:150px; width:300px; float:left">
Viết bình luận: <br><textarea rows="4" cols="40" name="bl"></textarea><br><input type="submit" name="ok" value="Đăng bình luận"><input type="submit" name="xoabl" value="Xóa tất cả bình luận">
</div>
<div style="float:left; width:500px">
<table width="400px">
<?php
	$a = mysqli_query($con, "select * from comment where idbaiviet = '$ID'");
	while($b = mysqli_fetch_array($a))
	{ ?>
    <tr><td><font color="#FF0000" style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold"><?php echo $b['taikhoan'].": ";  ?></font><font color="#000000" style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold"><?php echo $b['comment']; ?></font></td>
    <td width="70px">
    <font color="#FF0000" style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold"><font style=" padding-right:1px; font-size:14px"><a style="text-decoration:none" href='xoabl.php?xoa="<?php echo $b['id']; ?>"'>Xóa|</a></font></font>
    <font color="#FF0000" style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold"><font style=" padding-right:1px; font-size:14px"><a style="text-decoration:none" href='suabl.php?sua="<?php echo $b['id'];?>"'>Sửa</a></font></font>
    <br></td></tr>
	<?php } ?>
    
</table>
<?php
    if(isset($_POST['ok']))
	{
		$cmt = $_POST['bl'];
		$tk = $_SESSION['tk'];
		
		if(empty($cmt))
		{
			echo "<script>alert('Bạn chưa nhập bình luận')</script>";
		}
		else if(empty($tk))
		{
			echo "<script>alert('Bạn chưa đăng nhập, hãy đăng nhập để bình luận')</script>";
		}
		else
		{
			$bl = comment($cmt, $tk, $ID, $idtk);
			//if($bl == true) header("Refresh:0");
			header("location:baiviet.php?id=".$ID);
		}
	 }
	 if(isset($_POST['xoabl']))
	 {
		 if($_SESSION['tk'] != "admin")
		 {
			 echo "<script>alert('Chỉ người quản trị mới có quyền này')</script>";
		 }
		 else
		 {
			 $q = mysqli_query($con, "delete from comment");
			 header("location:baiviet.php?id=".$ID);
		 }	 
	 }
	 if(isset($_POST['dn']))
	 {
		header('location:dangnhap.php');
	 }
	 if(isset($_POST['dk']))
	 {
		header('location:dangky.php');
	 }
	 if(isset($_POST['tk1']))
	 {
		header('location:timkiem.php');
	 }
	 if(isset($_POST['themcd']))
	 {
		header('location:thembai.php');
	 }
	 if(isset($_POST['tk']))
	 {
		header('location:timkiem.php');
	 }
?>
</div>
</div>
</form>
</body>
</html>