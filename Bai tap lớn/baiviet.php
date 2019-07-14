<?php
	ob_start();
	require_once("connect.php");
	require_once("ham.php");
	session_start();
	$ID=$_GET['id'];
	$tt = "Tin tức - sự kiện";
	$x = mysqli_query($con, "select * from timkiem where id = '$ID'");
	$y = mysqli_fetch_array($x);
	?>	
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Bài viết</title>
<link rel="stylesheet" type="text/css" href="dd.css">
</head>
<body>
<form method="post" enctype="multipart/form-data">
<div style="width:1100px; height:3500px; background:#ffc; margin:auto" align="center">
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
<center><img src="img/banner3.jpg" width="1100px" height="200px"></center>
<div class="menu">
<div class="giua1">
<ul>
<?php
	 $m = mysqli_query($con, "select * from topic where topic != '$tt'");
	 while($n = mysqli_fetch_array($m))
	 { ?>
     <li><a href="dongy.php?id=<?php echo $n['id']; ?>"><?php echo $n['topic']; ?> </a></li>
     <?php } ?>
     <li style="background:#00F"><table style="background:#00F"><tr><td><textarea rows="1" cols="16" name="search1">Tìm kiếm...</textarea></td><td><input type="submit" name="search2" value="Tìm"></td></tr></table></li>
</ul>
</div>
</div><br>
<center><font style="font-family:Tahoma, Geneva, sans-serif; font-style:italic; font-size:20px; padding-left:10px; font-weight:bold"><a href="home.php" style="color:#00F; text-decoration:none">Trang chủ</a> » <a href="dongy.php?id=<?php echo $y['idtopic']; ?>" style="color:#00F; text-decoration:none"><?php echo $y['topic']; ?></a> » <a href="#" style="color:#00F; text-decoration:none">Bài viết</a></font><br><br>
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
<?php 
if($_SESSION['tk'] == "admin")
{ ?>
<input type="submit" name="themcd" value="Thêm bài viết"> <?php } ?></font><br><br>

<table align="center" cellpadding="1" width="750px">
<tr>
    <td><?php
	$ID=$_GET['id'];
	$_SESSION['idbv'] = $ID;
	$_SESSION['id'] = $ID;
	$x = mysqli_query($con, "select * from timkiem where id = '$ID'");
	$y = mysqli_fetch_array($x);
	$_SESSION['idbaiviet'] = $y['id'];
	$view = $y['luotxem'];
	$view = $view + 1;
	$m = mysqli_query($con, "update timkiem set luotxem = '$view' where id = $ID");
	$o = mysqli_query($con, "select * from comment where idbaiviet = '$ID'");
	$oo = mysqli_num_rows($o);
	?>
    <img width="100px" height="100px" src="img/<?php echo $y['anh']; ?> "></font>
	<td width="150px"><font style="font-weight:bold; font-size:16px; color:#00F"><?php echo $y['tenbaiviet']; ?></font></td>
    <td width="300px"><font style="font-weight:bold; font-size:14px; color:#666"><?php echo $z = substr( $y['noidung'],0,205)."..."; ?></font></td>
    <td width="200px"><font style=" font-size:14px">Chủ đề:</font><br><font style="font-weight:bold; font-size:14px"><a href="dongy.php?id=<?php echo $y['idtopic']; ?>" style="color:#00F; text-decoration:none"><?php echo $y['topic']; ?></a></font><br>
<font style=" font-size:14px;">Người tạo: </font><font style="font-weight:bold; font-size:14px; color:#F00"><?php echo $y['nguoitao']; ?></font></font><br>
<font style=" font-size:14px;">Ngày tạo: </font><font style="font-weight:bold; font-size:12px; color:#00F"><?php echo $y['time']; ?></font></font><br>
    <?php 
	if($_SESSION['tk'] == "admin")
	{ ?>
    <font style=" font-size:14px">Tùy chọn:</font><br>
    <font style=" padding-right:1px; font-size:14px"><a style="text-decoration:none; font-weight:bold; color:#00F" href='xoabai.php?xoa="<?php echo $y['id'];?>"' onClick="if(confirm('Bạn có thực sự muốn xóa?')) return true; else return false;">Xóa</a></font> <font style=" padding-right:1px; font-size:16px">•</font>
    <font style=" padding-right:1px; font-size:14px"><a style="text-decoration:none; font-weight:bold; color:#00F" href='suabai.php?sua="<?php echo $y['id'];?>"'>Sửa</a></font>
    <?php } ?>
    </td>
</tr>
</table>
<table align="center" width="700px">
<tr>
	<td><a href="home.php" style="text-decoration:none"><font style="font-weight:bold; font-size:16px; color:#00F">Home</font></a> » <a href="dongy.php?id=<?php echo $y['idtopic']; ?>" style="text-decoration:none"><font style="font-weight:bold; font-size:16px; color:#00F"><?php echo $y['topic']; ?></font></a></td>
</tr>
<tr>
	<td><font style="font-family:Tahoma, Geneva, sans-serif; color:#F00; font-weight:bold; font-size:14px"><?php date_default_timezone_set('Asia/Ho_Chi_Minh'); echo $y['time']; ?></font></td>
</tr>
<tr>
	<td><font style="font-weight:bold; font-size:14px">Chia sẻ: </font><img src="img/s1.PNG" width="20px" height="20px">
    <img src="img/s2.PNG" width="20px" height="20px">
    <img src="img/s3.PNG" width="20px" height="20px">
    <img src="img/s4.PNG" width="20px" height="20px">
    <img src="img/s5.PNG" width="20px" height="20px">
    <img src="img/s6.PNG" width="20px" height="20px">
    <font style="font-weight:bold; font-size:14px">&nbsp; Thích bài viết: </font><a href="like.php?id=<?php echo $y['id']; ?>"><img src="img/like2.png" width="55px" height="20px"></a><font style="font-weight:bold; font-size:14px">&nbsp; Thả tim bài viết: </font>
    <a href="heart.php?id=<?php echo $y['id']; ?>"><img src="img/heart.jpg" width="23px" height="20px"></a>
    </td>
</tr>
<tr>
	<td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold; font-size:24px"><?php echo $y['tenbaiviet']; ?></font></td>
</tr>
<tr>
	<td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold; font-size:17px; color:#666"><?php echo $z = substr( $y['noidung'],0,205)."..."; ?></font></td>
</tr>
<tr>
	<td><img width="800px" src="img/<?php echo $y['anhchinh']; ?> "></td>
</tr>
<tr>
	<td><?php echo $y['noidung']; ?></td>
</tr>
<tr>
	<td></td>
</tr>
</table>
<div style="float:left">
<table style="margin-left:150px">
<tr>
	<td><font style="font-weight:bold; font-size:14px">Share: &nbsp;</font><img src="img/s1.PNG" width="20px" height="20px">
    <img src="img/s2.PNG" width="20px" height="20px">
    <img src="img/s3.PNG" width="20px" height="20px">
    <img src="img/s4.PNG" width="20px" height="20px">
    <img src="img/s5.PNG" width="20px" height="20px">
    <img src="img/s6.PNG" width="20px" height="20px"></td>
</tr>
<tr>
	<td><font style="font-weight:bold; font-size:14px">Like: &nbsp;</font><a href="like.php?id=<?php echo $y['id']; ?>"><img src="img/like2.png" width="55px" height="20px"></a>
    <font style="font-weight:bold; font-size:14px">&nbsp; Heart: &nbsp; </font><a href="heart.php?id=<?php echo $y['id']; ?>"><img src="img/heart.jpg" width="23px" height="20px"></a>
    </td>
</tr>
<tr>
	<td><font style="font-weight:bold; font-size:14px; color:#C00">View Total: </font><font style="font-weight:bold; font-size:14px; color:#60F"><?php echo $y['luotxem']; ?></font></td>
</tr>
<tr>
	<td><font style="font-weight:bold; font-size:14px; color:#00F">Like Total: </font><font style="font-weight:bold; font-size:14px; color:#60F"><?php echo $y['thich']; ?></font></td>
</tr>
<tr>
	<td><font style="font-weight:bold; font-size:14px; color:#F0F">Heart Total: </font><font style="font-weight:bold; font-size:14px; color:#60F"><?php echo $y['thatim']; ?></font></td>
</tr>
<tr>
	<td><font style="font-weight:bold; font-size:14px; color:#0C0">Comment Total: </font><font style="font-weight:bold; font-size:14px; color:#60F"><?php echo $oo; ?></font></td>
</tr>
<tr>
	<td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold; color:#00F">Bình luận</font></td>
</tr>
</table>
</div>
<div style="float:left">
<table align="left" style="margin-left:100px" width="480px">
<tr>
	<td><font style="font-weight:bold; font-size:14px; color:#00F">Bài viết liên quan</font></td>
</tr>
<tr>
	<td>
    <?php
	$dem = 0;
	$idtopic = $y['idtopic'];
	$g = mysqli_query($con, "select * from timkiem where idtopic = $idtopic and id != $ID");
	while($gg = mysqli_fetch_array($g))
	{ 
		$dem = $dem + 1; 
		if($dem <= 2)
		{ ?>
    <font style="color:red; font-weight:bold"> • </font>
    <a href="baiviet.php?id=<?php echo $gg['id']; ?>" style="text-decoration:none; color:#060; font-size:14px"><?php echo $gg['tenbaiviet']; ?></a><br>
    	<?php } ?>
    <?php } ?>
    </td>
</tr>
</table>
</div>
<div style="clear:both"></div>
<div style="margin-left:150px; width:300px; float:left; font-family:Tahoma, Geneva, sans-serif; font-style:italic; font-size:14px">
Viết bình luận: <br><textarea rows="4" cols="40" name="bl">
<?php
	echo $_SESSION['cmt_tam'].$_SESSION['icon'];
?>
</textarea><br><input type="submit" name="ok" value="Đăng bình luận"><input type="submit" name="themicon" value="Thêm một icon cảm xúc">
<?php 
if($_SESSION['tk'] == "admin")
{ ?>
<input type="submit" name="xoabl" value="Xóa tất cả bình luận"><input type="submit" name="qlicon" value="Tạo mới icon"> <?php } ?>
</div>
<div style="float:left; width:520px">
<table width="520px">
<?php
	$a = mysqli_query($con, "select * from comment where idbaiviet = '$ID'");
	while($b = mysqli_fetch_array($a))
	{ ?>
    <tr><td><font color="#0000FF" style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold; font-size:13px"><?php echo $b['taikhoan'].": "; ?></font><font color="#000000" style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold; font-size:13px"><?php echo $b['comment']; ?></font></td>
    <td width="80px">
<?php
 if($b['taikhoan'] == $_SESSION['tk'] || $_SESSION['tk'] == "admin")
 { ?>
    <font color="#FF0000" style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold"><font style=" padding-right:1px; font-size:13px"><a style="text-decoration:none; color:#00F" href='xoabl.php?xoa="<?php echo $b['id']; ?>"' onClick="if(confirm('Bạn có thực sự muốn xóa?')) return true; else return false;">Xóa</a></font></font><font color="#FF0000" style="font-family:Tahoma, Geneva, sans-serif;"> • </font><font color="#FF0000" style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold"><font style=" padding-right:1px; font-size:13px; color:#00F"><a style="text-decoration:none; color:#00F" href='suabl.php?sua="<?php echo $b['id'];?>"'>Sửa</a></font></font><?php } ?>
    <br></td></tr>
	<?php } ?>
</table>
<?php
    if(isset($_POST['ok']))
	{
		if($_SESSION['tk'] == "")
		{
			echo "<script>alert('Bạn chưa đăng nhập, hãy đăng nhập để bình luận')</script>";
		}
		else
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
				$bl = comment($cmt, $tk, $ID);
				header("location:baiviet.php?id=".$ID);
			}
			$_SESSION['cmt_tam'] = '';
			$_SESSION['icon'] = '';
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
		$_SESSION['timkiem'] = $_POST['tim'];
		header('location:timkiem.php');
	 }
	 if(isset($_POST['qlicon']))
	 {
		header('location:themicon.php');
	 }
	 if(isset($_POST['themicon']))
	 {
		if($_SESSION['tk'] == "")
		{
			echo "<script>alert('Bạn phải đăng nhập để sử dụng chức năng này')</script>";
		}
		else
		{
			$_SESSION['cmt_tam'] = $_POST['bl'];
			header('location:icon.php');
		}
	 }
	 ob_end_flush();
?>
</div>
</div>
</form>
</body>
</html>