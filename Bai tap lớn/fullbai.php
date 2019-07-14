<?php
	ob_start();
	require_once("connect.php");
	require_once("ham.php");
	session_start();
	$_SESSION['cmt_tam'] = '';
	$tt = "Tin tức - sự kiện";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Xem tất cả các bài</title>
<link rel="stylesheet" type="text/css" href="dd.css">
</head>
<body>
<form method="post" enctype="multipart/form-data">
<div style="width:1100px; height:3000px; background:#ffc; margin:auto" align="center">
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
<img src="img/banner3.jpg" width="1100px" height="200px"><br>
<div class="menu">
<div class="giua1">
<ul>
<?php
	 $m = mysqli_query($con, "select * from topic where topic != '$tt'");
	 while($n = mysqli_fetch_array($m))
	 { ?>
     <li><a href="dongy.php?id=<?php echo $n['id']; ?>"><?php echo $n['topic']; ?></a></li>
     <?php } ?>
     <li style="background:#00F"><table style="background:#00F"><tr><td><textarea rows="1" cols="16" name="search1">Tìm kiếm...</textarea></td><td><input type="submit" name="search2" value="Tìm"></td></tr></table></li>
</ul>
</div>
</div>
<font style="font-family:Tahoma, Geneva, sans-serif; font-style:italic; font-size:20px; padding-left:10px; font-weight:bold; color:#00F"><a href="home.php" style="color:#00F; text-decoration:none">Trang chủ</a> » <a href="#" style="color:#00F; text-decoration:none"><?php
	$id = $_GET['id'];
	if($id == 1)
	{
		$q = mysqli_query($con, "select * from timkiem order by luotxem desc");
		$tieude = "Tin nổi bật";
	}
	if($id == 2)
	{
		$q = mysqli_query($con, "select * from timkiem order by time desc");
		$tieude = "Tin mới nhất";
	}
	if($id == 3)
	{
		$q = mysqli_query($con, "select * from timkiem order by thich desc");
		$tieude = "Yêu thích nhất";
	}
	$num = mysqli_fetch_array($q);
	echo $tieude;
?></a></font><br><br>
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
<?php 
if($_SESSION['tk'] == "admin")
{ ?>
<input type="submit" name="tk" value="Tìm kiếm bài viết">
<input type="submit" name="themcd" value="Thêm bài viết">
<input type="submit" name="xem" value="Xem tất cả bài viết"> <?php } ?>
<?php 
if($_SESSION['tk'] != "admin")
{ ?>
<input type="submit" name="tk" value="Tìm kiếm bài viết"><?php } ?></font><br><br>
<font style="font-family:Tahoma, Geneva, sans-serif; font-size:20px; padding-left:10px; font-weight:bold">Xem tin tức:</font>
 <font style="font-family:Tahoma, Geneva, sans-serif; font-size:20px; padding-left:10px; font-weight:bold; color:#F00">
<a href="#" style="color:#00F; text-decoration:none"><?php
	$id = $_GET['id'];
	if($id == 1)
	{
		$q = mysqli_query($con, "select * from timkiem order by luotxem desc");
		$tieude = "Tin nổi bật";
	}
	if($id == 2)
	{
		$q = mysqli_query($con, "select * from timkiem order by time desc");
		$tieude = "Tin mới nhất";
	}
	if($id == 3)
	{
		$q = mysqli_query($con, "select * from timkiem order by thich desc");
		$tieude = "Yêu thích nhất";
	}
	$num = mysqli_fetch_array($q);
	echo $tieude;
?></a>
<font style="font-family:Tahoma, Geneva, sans-serif; font-size:15px; padding-left:10px; font-weight:bold; color:#F00">(Có tất cả <?php echo mysqli_num_rows($q); ?> bài viết)</font>
</font><br>
<table cellpadding="5" width="800px">
<tr>
<td>
	<?php
	while($num = mysqli_fetch_array($q))
	{ ?>
		<a href="baiviet.php?id=<?php echo $num['id']; ?>"><img style="float:left" width="100px" height="100px" src="img/<?php echo $num['anh'];?> "></a><a href="baiviet.php?id=<?php echo $num['id']; ?>" style="text-decoration:none"><font style="color:#00F; font-weight:bold; font-size:16px; font-family:Tahoma, Geneva, sans-serif"><?php echo $num['tenbaiviet']; ?></font></a><br><font style=" font-size:14px; font-family:Tahoma, Geneva, sans-serif"><?php $noidung = substr( $num['noidung'],0,300); echo $noidung."..."; ?></font> <font style="color:#000; font-weight:bold; font-size:12px"><a href="dongy.php?id=<?php echo $num['idtopic']; ?>" style="color:#00F; text-decoration:none">- <?php echo $num['topic']; ?></a></font></font><br>
<font style=" font-size:12px; font-family:Tahoma, Geneva, sans-serif; font-style:italic;"><?php echo $num['time']; ?> | Người tạo: <?php echo $num['nguoitao']; ?> | <?php echo $num['luotxem']; ?> lượt xem | <?php echo $num['thich']; ?> lượt thích | <?php echo $num['thatim']; ?> lượt thả tim
<?php
if($_SESSION['tk'] == "admin")
{ ?>
| Tùy chọn: <font style=" padding-right:1px; font-size:12px"><a style="text-decoration:none; font-weight:bold; color:#00F" href='xoabai.php?xoa="<?php echo $num['id'];?>"' onClick="if(confirm('Bạn có thực sự muốn xóa?')) return true; else return false;">Xóa</a></font> • <font style=" padding-right:1px; font-size:12px"><a style="text-decoration:none; font-weight:bold; color:#00F" href='suabai.php?sua="<?php echo $num['id'];?>"'>Sửa</a></font> <?php } ?></font>
<div style="clear:both"><?php } ?></div>
</td>
</tr>
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
		$_SESSION['timkiem'] = $_POST['tim'];
		header('location:timkiem.php');
	}
	if(isset($_POST['themcd']))
	{
		header('location:thembai.php');
	}
	if(isset($_POST['xem']))
	 {
		 header('location:fullbai.php');
	 }
	 ob_end_flush();
?>