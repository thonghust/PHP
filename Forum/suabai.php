<?php
	require_once("connect.php");
	require_once("ham.php");
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sửa bài viết</title>
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
<center><img src="logo.jpg" width="850px" height="200px"></center><br>
<h1>» Trang tin tức hay nhất Việt Nam «</h1>
<font style="font-family:Tahoma, Geneva, sans-serif; font-style:italic; font-size:20px; padding-left:10px; font-weight:bold"><a href="home.php">Trang chủ</a> » <a href="suabai.php">Sửa tin tức</a></font><br><br>
<input type="submit" name="tk2" value="Tìm kiếm bài viết"></font><br><br>
<?php
	$id = $_REQUEST['sua'];
	$q = mysqli_query($con, "select * from timkiem where id = $id");
	$num = mysqli_fetch_array($q);
	$a = $num['topic'];
	$b = $num['nguoitao'];
	$c = $num['anh'];
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
	<td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Chọn ảnh</font></td>
</tr>
<tr align="center">
	<td><img width="100px" height="100px" src="img/<?php echo $c; ?> "><br><input type="file" name="anh"></td>
</tr>
<tr align="center">
	<td><input type="submit" name="ok" value="Sửa bài viết"></td>
</tr>
</table>
</div>
</form>
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
			if($b != $_SESSION['tk'] && $_SESSION['tk'] != "admin")
			{
				echo "<script>alert('Bạn không thể sửa bài viết của người khác')</script>";
			}
			else
			{
				$sua = suabai($id, $tenbai, $nd, $b1);
				header('location:home.php');
			}
		}
	}
	if(isset($_POST['tk2']))
	{
		header('location:timkiem.php');
	}
?>