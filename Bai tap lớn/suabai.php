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
<title>Sửa bài viết</title>
<script src="ckeditor/ckeditor/ckeditor.js"></script>
</head>
<body>
<form method="post" enctype="multipart/form-data">
<div style="width:1000px; height:1650px; background:#ffc; margin:auto" align="center">
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
<center><img src="img/banner3.jpg" width="1000px" height="200px"></center><br>
<h1 style="color:#FFF; font-weight:bold; font-size:26px; font-family:Tahoma, Geneva, sans-serif; background-color:#00F">» Trang tin tức hay nhất Việt Nam «</h1>
<font style="font-family:Tahoma, Geneva, sans-serif; font-style:italic; font-size:20px; padding-left:10px; font-weight:bold"><a href="home.php" style="color:#00F; text-decoration:none">Trang chủ</a> » <a href="#" style="text-decoration:none; color:#00F">Sửa tin tức</a></font><br><br>
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
	if(isset($_POST['tk2']))
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
<input type="submit" name="tk2" value="Tìm kiếm bài viết"></font><br><br>
<?php
	$id = $_REQUEST['sua'];
	$q = mysqli_query($con, "select * from timkiem where id = $id");
	$num = mysqli_fetch_array($q);
	$a = $num['topic'];
	$b = $num['nguoitao'];
	$c = $num['anh'];
	$d = $num['id'];
	$e = $num['anhchinh'];
?>
<table align="center" border="1" cellpadding="5" width="700px">
<tr>
	<td align="center"><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Tên bài viết</font></td>
</tr>
<tr align="center">
	<td><textarea name="tenbv" rows="4" cols="60"><?php echo $num['tenbaiviet']; ?></textarea></td>
</tr>
<tr align="center">
	<td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Nội dung</font></td>
</tr>
<tr align="center">
	<td><textarea name="nd" rows="7" cols="60"><?php echo $num['noidung']; ?></textarea></td>
</tr>
<tr align="center">
	<td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Chọn chủ đề</font></td>
</tr>
<tr align="center">
	<td>
    	<select name="topic"> <?php
			$q = mysqli_query($con, "select * from topic where topic = '$a'");
			while($num = mysqli_fetch_array($q))
			{ ?>
        	<option value="<?php echo $num['id']; echo $num['topic']; ?>" <?php if($num['topic'] = $a) echo "selected"; ?>><?php echo $num['topic']; ?></option> <?php } ?>
        </select>
    </td>
</tr>
<tr align="center">
	<td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Chọn ảnh tiêu đề</font></td>
</tr>
<tr align="center">
	<td><img width="100px" height="100px" src="img/<?php echo $c; ?> "><br><input type="file" name="anh"></td>
</tr>
<tr align="center">
	<td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Chọn ảnh nội dung chính</font></td>
</tr>
</tr>
<tr align="center">
	<td><img width="400px" src="img/<?php echo $e; ?> "><br><input type="file" name="anhchinh"></td>
</tr>
<tr align="center">
	<td><input type="submit" name="ok" value="Sửa bài viết"><input type="submit" name="back" value="Quay lại bài viết"><input type="submit" name="home" value="Trang chủ"></td>
</tr>
</table>
</div>
</form>
<script>//CKEDITOR.replace('nd')</script>
<script>//CKEDITOR.replace('tenbv')</script>
</body>
</html>
<?php
	if(isset($_POST['ok']))
	{
		$tenbai = $_POST['tenbv'];
		$nd = $_POST['nd'];
		
		$a1 = $_FILES['anh']['tmp_name'];
		$b1 = $_FILES['anh']['name'];
		$c1 = move_uploaded_file($a1,'img/'.$b1);
		
		$a2 = $_FILES['anhchinh']['tmp_name'];
		$b2 = $_FILES['anhchinh']['name'];
		$c2 = move_uploaded_file($a2,'img/'.$b2);
		
		if(empty($tenbai))
		{
			echo "<script>alert('Tên bài viết không được để trống')</script>";
		}
		if(empty($nd))
		{
			echo "<script>alert('Nội dung không được để trống')</script>";
		}
		else
		{
			if($_SESSION['tk'] != "admin")
			{
				echo "<script>alert('Bạn không thể sửa bài viết, chỉ quản trị viên mới có quyền này')</script>";
			}
			else
			{
				$sua = suabai($id, $tenbai, $nd, $b1, $b2);
				header('location:home.php');
			}
		}
	}
	if(isset($_POST['tk2']))
	{
		$_SESSION['timkiem'] = $_POST['tim'];
		header('location:timkiem.php');
	}
	if(isset($_POST['back']))
	{
		header("location:baiviet.php?id=".$d);
	}
	if(isset($_POST['home']))
	{
		header('location:home.php');
	}
	ob_end_flush();
?>