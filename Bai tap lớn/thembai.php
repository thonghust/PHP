<?php
	require_once("connect.php");
	require_once("ham.php");
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Thêm bài viết</title>
<script src="ckeditor/ckeditor/ckeditor.js"></script>
</head>
<body>
<form method="post" enctype="multipart/form-data">
<div style="width:1000px; height:1330px; background:#ffc; margin:auto" align="center">
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
<font style="font-family:Tahoma, Geneva, sans-serif; font-style:italic; font-size:20px; padding-left:10px; font-weight:bold"><a href="home.php" style="color:#00F; text-decoration:none">Trang chủ</a> » <a href="#" style="color:#00F; text-decoration:none">Thêm tin tức</a></font><br><br>
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
<input type="submit" name="tk2" value="Tìm kiếm tin tức"></font><br><br>
<table align="center" border="1" cellpadding="5" width="700px">
<tr align="center">
	<td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Tên bài viết</font></td>
</tr>
<tr align="center">
	<td><textarea name="tenbv" rows="4" cols="60"></textarea></td>
</tr>
<tr align="center">
	<td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Nội dung</font></td>
</tr>
<tr align="center">
	<td><textarea name="nd" rows="7" cols="60"></textarea></td>
</tr>
<tr align="center">
	<td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Chọn chủ đề</font></td>
</tr>
<tr align="center">
	<td>
    	<select name="topic"> <?php
			$q = mysqli_query($con, "select * from topic");
			while($num = mysqli_fetch_array($q))
			{ ?>
        	<option><?php echo $num['topic']; ?></option> <?php } ?>
        </select>
    </td>
</tr>
<tr align="center">
	<td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Chọn ảnh tiêu đề</font></td>
</tr>
<tr align="center">
	<td><input type="file" name="anh"></td>
</tr>
<tr align="center">
	<td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Chọn ảnh nội dung chính</font></td>
</tr>
<tr align="center">
	<td><input type="file" name="anhchinh"></td>
</tr>
<tr align="center">
	<td><input type="submit" name="ok" value="Thêm mới"><input type="submit" name="home" value="Trang chủ"></td>
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
		$a = $_FILES['anh']['tmp_name'];
		$b = $_FILES['anh']['name'];
		$c = move_uploaded_file($a,'img/'.$b);
		if($c) echo "OK"; else "Fall";
		
		$d = $_FILES['anhchinh']['tmp_name'];
		$e = $_FILES['anhchinh']['name'];
		$f = move_uploaded_file($d,'img/'.$e);
		if($f) echo "OK"; else "Fall";
		
		$tenbai = $_POST['tenbv'];
		$nd = $_POST['nd'];
		$topic = $_POST['topic'];
		$q1 = mysqli_query($con, "select * from topic where topic = '$topic'");
		$num1 = mysqli_fetch_array($q1);
		$idtopic = $num1['id'];
		if(empty($tenbai))
		{
			echo "<script>alert('Tên bài viết không được để trống')</script>";
		}
		if(empty($nd))
		{
			echo "<script>alert('Nội dung không được để trống')</script>";
		}
		else if($_SESSION['tk'] != "admin")
		{
			echo "<script>alert('Bạn không thể thêm bài viết, đăng nhập dưới quyền quản trị viên để thực hiện thao tác này')</script>";
		}
		else if($tenbai)
		{
			$time = date('Y-m-d H:i:s');
			$nguoi = $_SESSION['tk'];
			$them = thembaiviet($tenbai, $nd, $nguoi, $topic, $idtopic, $b, $bai, $time, $e);
			header('location:home.php');
		}
	}
	if(isset($_POST['tk2']))
	{
		$_SESSION['timkiem'] = $_POST['tim'];
		header('location:timkiem.php');
	}
	if(isset($_POST['home']))
	{
		header('location:home.php');
	}
?>