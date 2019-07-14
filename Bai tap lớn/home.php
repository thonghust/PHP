<?php 
	ob_start();
	require_once("connect.php");
	require_once("ham.php");
	session_start();
	unset($_SESSION['sort']);
	if(isset($_SESSION['tk']))
	{
		$taikhoan = $_SESSION['tk'];
	}
	else
	{
		$_SESSION['tk'] = '';
		$taikhoan = '';
	}
	$_SESSION['cmt_tam'] = '';
	$_SESSION['icon'] = '';
	$tt = "Tin tức - sự kiện";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Trang chủ</title>
<link rel="stylesheet" type="text/css" href="dd.css">
</head>
<body>
<form method="post" enctype="multipart/form-data">
<div style="width:1100px; height:2550px; background:#ffc; margin:auto" align="center">
<div style="float:left"><font style="color:#00F; font-weight:bold; font-size:16px; font-family:Tahoma, Geneva, sans-serif">Giới thiệu</font><font style="color:#F00; font-weight:bold; font-size:16px; font-family:Tahoma, Geneva, sans-serif"> | </font><font style="color:#00F; font-weight:bold; font-size:16px; font-family:Tahoma, Geneva, sans-serif">Liên hệ</font><font style="color:#F00; font-weight:bold; font-size:16px; font-family:Tahoma, Geneva, sans-serif"> | </font><font style="color:#00F; font-weight:bold; font-size:16px; font-family:Tahoma, Geneva, sans-serif">Góp ý</font></div>
<div style="float:left; margin-left:200px"><center><font style="color:#00F; font-weight:bold; font-size:16px; font-family:Tahoma, Geneva, sans-serif"><?php 
    if(isset($_SESSION['tk']) && $_SESSION['tk'] != '')
	{
		echo "Xin chào, " ?><font style="color:#F00; font-weight:bold; font-size:16px; font-family:Tahoma, Geneva, sans-serif"><?php echo $_SESSION['tk']. " "; ?></font>
     <font style="font-weight:bold; font-size:16px; font-family:Tahoma, Geneva, sans-serif; color:#60F">[</font><a href="dangxuat.php" style="color:#00F; text-decoration:none">Đăng xuất</a></font>
     <font style="font-weight:bold; font-size:16px; font-family:Tahoma, Geneva, sans-serif; color:#60F">]</font>
     <?php
	}
	 else
	{ ?>
    Bạn chưa đăng nhập 
    <input type="submit" name="dn" value="Đăng nhập"> ngay, hoặc
	<input type="submit" name="dk" value="Đăng ký"> <?php } ?></div><div align="right">
    <img src="img/vn.jpg" width="28" height="20"> <img src="img/en.jpg" width="28" height="20"> <img src="img/us.png" width="28" height="20"> <img src="img/cn.png" width="28" height="20"> <img src="img/nga.png" width="28" height="20"> 
</div></font>
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
     <li style="background:#00F"><table style="background:#00F"; height="32px"><tr><td><textarea rows="1" cols="14" name="search1"></textarea></td><td><input type="submit" name="search2" value="Tìm"></td></tr></table></li>
</ul>
</div>
</div><br>
<table>
<tr>
	<td><select name="sapxep">
    	<option>Sắp xếp theo</option>
    	<option>Theo ngày tạo</option>
        <option>Xem nhiều nhất</option>
        <option>Like nhiều nhất</option>
        <option>Heart nhiều nhất</option>
    </select></td>
    <?php
	if(isset($_POST['ok']) || isset($_POST['search2']))
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
	if($taikhoan == "admin")
	  	{ ?>
            <input type="submit" name="ok" value="Tìm kiếm tin tức">
            <input type="submit" name="themcd" value="Thêm tin tức">
            <input type="submit" name="qltopic" value="Quản lý chủ đề">
            <input type="submit" name="qltk" value="Quản lý tài khoản">
  <?php } 
  	  else { ?>
<input type="submit" name="ok" value="Tìm kiếm tin tức">
	<?php } ?>
</font><br><br>
<font style="font-family:Tahoma, Geneva, sans-serif; color:#F00; font-weight:bold; font-size:14px"><?php date_default_timezone_set('Asia/Ho_Chi_Minh'); echo "Hôm nay, ".date(DATE_RFC2822); ?></font>
<div style="clear:both"></div>
<?php
	$q2 = mysqli_query($con, "select * from topic where topic != '$tt'");
?>
<table align="left" cellpadding="5" width="700px">
<?php 
	while($num2 = mysqli_fetch_array($q2))
	{ ?>
<tr>
	<td><div><a href="dongy.php?id=<?php echo $num2['id']; ?>" style="text-decoration:none"><b><span style="color:#FFF; font-weight:bold; font-size:25px; font-family:Tahoma, Geneva, sans-serif; background:#00F; float:left"><?php echo $num2['topic']; ?></span></b></a></div><div class="tamgiac"></div><br><div><hr color="#0000FF"></div>
    <div style="clear:both"></div>
    <?php 
	$cc = $num2['id'];
	$q1 = mysqli_query($con, "select * from timkiem where idtopic = '$cc'");
	while($num1 = mysqli_fetch_array($q1))
	{ ?>
    <a href="baiviet.php?id=<?php echo $num1['id']; ?>"><img style="float:left" width="100px" height="100px" src="img/<?php echo $num1['anh'];?> "></a><a href="baiviet.php?id=<?php echo $num1['id']; ?>" style="text-decoration:none"><font style="color:#00F; font-weight:bold; font-size:16px; font-family:Tahoma, Geneva, sans-serif"><?php echo $num1['tenbaiviet']; ?></font></a><br><font style=" font-size:14px; font-family:Tahoma, Geneva, sans-serif"><?php $noidung = substr( $num1['noidung'],0,300); echo $noidung."..."; ?></font><br><font style=" font-size:12px; font-family:Tahoma, Geneva, sans-serif; font-style:italic;"><?php date_default_timezone_set('Asia/Ho_Chi_Minh'); echo $num1['time']; ?> | Người tạo: <?php echo $num1['nguoitao']; ?> | <?php echo $num1['luotxem']; ?> lượt xem | <?php echo $num1['thich']; ?> lượt thích | <?php echo $num1['thatim']; ?> lượt thả tim
<?php
if($_SESSION['tk'] == "admin")
{ ?>
| Tùy chọn: <font style=" padding-right:1px; font-size:12px"><a style="text-decoration:none; font-weight:bold; color:#00F" href='xoabai.php?xoa="<?php echo $num1['id'];?>"' onClick="if(confirm('Bạn có thực sự muốn xóa?')) return true; else return false;">Xóa</a></font> • <font style=" padding-right:1px; font-size:12px"><a style="text-decoration:none; font-weight:bold; color:#00F" href='suabai.php?sua="<?php echo $num1['id'];?>"'>Sửa</a></font> <?php } ?></font>
<div style="clear:both"><?php } ?></div></td>
</tr>
<?php } ?>
</table>
<div style="float:right; width:200px">
<table width="200px">
<tr>
	<td align="center" width="200px" style="color:#FFF; font-weight:bold; font-size:15px; font-family:Tahoma, Geneva, sans-serif; background-color:#00F"><a href="fullbai.php?id=1" style="color:#FFF; text-decoration:none">Tin nổi bật</a></td>
</tr>
<?php
	$dem = 0;
	$w = mysqli_query($con, "select * from timkiem order by luotxem desc");
	while($u = mysqli_fetch_array($w))
	{
		$dem = $dem + 1;
		if($dem <= 6)
		{
		?>
<tr>
	<td>
    <font style="color:#00F; font-weight:bold; font-size:14px; font-family:Tahoma, Geneva, sans-serif"><a href="baiviet.php?id=<?php echo $u['id']; ?>" style="color:#00F; text-decoration:none"><img style="float:left" width="100px" height="100px" src="img/<?php echo $u['anh'];?> "></a></font>
    <font style="color:#00F; font-size:12px; font-family:Tahoma, Geneva, sans-serif"><a href="baiviet.php?id=<?php echo $u['id']; ?>" style="color:#00F; text-decoration:none"><?php echo $u['tenbaiviet']; ?></a></font><br>
    
    <?php
if($_SESSION['tk'] == "admin")
{ ?>
<font style=" padding-right:1px; font-size:12px"><a style="text-decoration:none; font-weight:bold; color:#00F" href='xoabai.php?xoa="<?php echo $u['id'];?>"' onClick="if(confirm('Bạn có thực sự muốn xóa?')) return true; else return false;">Xóa</a></font> • <font style=" padding-right:1px; font-size:12px"><a style="text-decoration:none; font-weight:bold; color:#00F" href='suabai.php?sua="<?php echo $u['id'];?>"'>Sửa</a></font> <?php } ?></font>

    
    </td>
</tr>
    <?php } 
	} ?>
    <tr>
	<td align="center" width="200px" style="color:#FFF; font-weight:bold; font-size:15px; font-family:Tahoma, Geneva, sans-serif; background-color:#00F"><a href="fullbai.php?id=2" style="color:#FFF; text-decoration:none">Tin mới nhất</a></td>
</tr>
<?php
	$dem = 0;
	$w = mysqli_query($con, "select * from timkiem order by time desc");
	while($u = mysqli_fetch_array($w))
	{
		$dem = $dem + 1;
		if($dem <= 6)
		{
		?>
<tr>
	<td>
    <font style="color:#00F; font-weight:bold; font-size:14px; font-family:Tahoma, Geneva, sans-serif"><a href="baiviet.php?id=<?php echo $u['id']; ?>" style="color:#00F; text-decoration:none"><img style="float:left" width="100px" height="100px" src="img/<?php echo $u['anh'];?> "></a></font>
    <font style="color:#00F; font-size:12px; font-family:Tahoma, Geneva, sans-serif"><a href="baiviet.php?id=<?php echo $u['id']; ?>" style="color:#00F; text-decoration:none"><?php echo $u['tenbaiviet']; ?></a></font><br>
    
    <?php
if($_SESSION['tk'] == "admin")
{ ?>
<font style=" padding-right:1px; font-size:12px"><a style="text-decoration:none; font-weight:bold; color:#00F" href='xoabai.php?xoa="<?php echo $u['id'];?>"' onClick="if(confirm('Bạn có thực sự muốn xóa?')) return true; else return false;">Xóa</a></font> • <font style=" padding-right:1px; font-size:12px"><a style="text-decoration:none; font-weight:bold; color:#00F" href='suabai.php?sua="<?php echo $u['id'];?>"'>Sửa</a></font> <?php } ?></font>

    
    </td>
</tr>
    <?php } 
	} ?>
    <tr>
	<td align="center" width="200px" style="color:#FFF; font-weight:bold; font-size:15px; font-family:Tahoma, Geneva, sans-serif; background-color:#00F"><a href="fullbai.php?id=3" style="color:#FFF; text-decoration:none">Yêu thích nhất</a></td>
</tr>
<?php
	$dem = 0;
	$w = mysqli_query($con, "select * from timkiem order by thich desc");
	while($u = mysqli_fetch_array($w))
	{
		$dem = $dem + 1;
		if($dem <= 6)
		{
		?>
<tr>
	<td>
    <font style="color:#00F; font-weight:bold; font-size:14px; font-family:Tahoma, Geneva, sans-serif"><a href="baiviet.php?id=<?php echo $u['id']; ?>" style="color:#00F; text-decoration:none"><img style="float:left" width="100px" height="100px" src="img/<?php echo $u['anh'];?> "></a></font>
    <font style="color:#00F; font-size:12px; font-family:Tahoma, Geneva, sans-serif"><a href="baiviet.php?id=<?php echo $u['id']; ?>" style="color:#00F; text-decoration:none"><?php echo $u['tenbaiviet']; ?></a></font><br>
    
    <?php
if($_SESSION['tk'] == "admin")
{ ?>
<font style=" padding-right:1px; font-size:12px"><a style="text-decoration:none; font-weight:bold; color:#00F" href='xoabai.php?xoa="<?php echo $u['id'];?>"' onClick="if(confirm('Bạn có thực sự muốn xóa?')) return true; else return false;">Xóa</a></font> • <font style=" padding-right:1px; font-size:12px"><a style="text-decoration:none; font-weight:bold; color:#00F" href='suabai.php?sua="<?php echo $u['id'];?>"'>Sửa</a></font> <?php } ?></font>

    
    </td>
</tr>
    <?php } 
	} ?>
<tr>
	<td width="200px"><img src="img/qc7.PNG" width="200px"><img src="img/qc2.jpg" width="200px" height="140px"></td>
</tr>
</table>
<img src="img/phaidep.PNG" width="200px"></div>
<?php
	$ii = mysqli_query($con, "select * from timkiem where topic = '$tt'");
	$iii = mysqli_fetch_array($ii);
?>
<div style="float:right; width:200px">
<table width="200px">
<tr>
	<td align="center" width="200px"><img src="img/thoitiet.PNG" width="200px"><a href="dongy.php?id=<?php echo $iii['idtopic']; ?>"><img src="img/ttsk.PNG" width="200px"></a></td>
</tr>
<br>
<tr align="left">
<td>
<?php
	$g = mysqli_query($con, "select * from timkiem where topic = '$tt'");
	while($f = mysqli_fetch_array($g))
	{ ?>
    <font style="font-size:12px; font-weight:bold; font-family:Tahoma, Geneva, sans-serif; color:#F00"> • </font><font style="font-size:12px; font-family:Tahoma, Geneva, sans-serif; color:#060"><a href="baiviet.php?id=<?php echo $f['id']; ?>" style="text-decoration:none; color:#060"><?php echo $f['tenbaiviet']; ?></a></font><br>
<?php } ?>
<font style="font-size:12px; font-family:Tahoma, Geneva, sans-serif; color:#F30; font-style:italic;">
<a href="dongy.php?id=<?php echo $iii['idtopic']; ?>" style="text-decoration:none; color:#F30">» Xem tiếp « </a>
</font>
</td>
</tr>
<tr>
	<td><img src="img/tttt.PNG" width="200px"></td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td><img src="img/quangcao.PNG" width="200px"></td>
</tr>
<tr>
	<td><img src="img/qc1.jpg" width="200px"></td>
</tr>
<tr>
	<td><img src="img/qc6.PNG" width="200px"></td>
</tr>
<tr>
	<td><img src="img/qc.png" width="200px"></td>
</tr>
<tr>
	<td><img src="img/qc8.PNG" width="200px" height="116px"></td>
</tr>
</table>
</div>




<div style="clear:both"></div>
<div align="center" style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold; font-size:16px; color:#FFF; background:#00F">Website: www.Thongvan.Com - www.Thonghust.Vn<br>
© THONGVAN 2018. All rights reserved.</div>
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
		$_SESSION['timkiem'] = $_POST['tim'];
		header('location:timkiem.php');
	}
	if(isset($_POST['search2']))
	{
		$_SESSION['timkiem'] = $_POST['search1'];
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
	if(isset($_POST['qltk']))
	{
		header('location:qltaikhoan.php');
	}
ob_end_flush(); ?>