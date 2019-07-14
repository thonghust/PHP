<?php
	require_once("connect.php");
	require_once("ham.php");
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Kết quả tìm kiếm</title>
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
<font style="font-family:Tahoma, Geneva, sans-serif; font-style:italic; font-size:20px; padding-left:10px; font-weight:bold"><a href="home.php">Trang chủ</a> »  <a href="timkiem.php">Tìm kiếm</a></font><br><br>
<font style="font-family:Tahoma, Geneva, sans-serif; font-style:italic; font-size:20px; padding-left:10px; font-weight:bold">Tìm kiếm bài viết</font><br><br>
<input type="text" name="txttimkiem"><br>
<input type="submit" name="ok" value="Tìm kiếm bài viết"></font><br><br>
<font style="font-family:Tahoma, Geneva, sans-serif; font-style:italic; font-size:20px; padding-left:10px; font-weight:bold">Kết quả tìm kiếm</font><br><br>
<table align="center" border="1" cellpadding="5" width="700px">
<tr align="center">
	<td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Tên bài viết</font></td>
    <td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Người tạo</font></td>
    <td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Tùy chọn</font></td>
</tr>
<?php
		if(isset($_POST['ok'])){
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$tukhoa = $_POST['txttimkiem'];
		if(empty($tukhoa)) echo "<script>alert('Nội dung không được để trống')</script>";
		else{
		$q = mysqli_query($con, "select * from timkiem where tenbaiviet like '%$tukhoa%'");
				if(mysqli_num_rows($q) == 0)
				{
					echo "<script>alert('Không tìm thấy bài viết nào')</script>";
				}
				else
				{
					while($num = mysqli_fetch_array($q))
					{ ?>
		<tr align="center">
			<td><a href="baiviet.php?id=<?php echo $num['id']; ?>"><?php echo $num['tenbaiviet']; ?></a></td>
			<td width="100px" align="center"><?php echo $num['nguoitao']; ?><br><?php  echo date("d:m:y"); ?></td>
            <td width="80px"><font style=" padding-right:1px; font-size:14px"><a style="text-decoration:none; font-weight:bold" href='xoabai.php?xoa="<?php echo $num['id'];?>"'>Xóa</a></font></td>
		</tr>            
			  <?php }
				}
			}
		}
?>
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
	if(isset($_POST['themcd']))
	{
		header('location:thembai.php');
	}
?>