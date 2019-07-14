<?php
	require_once("connect.php");
	require_once("ham.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sửa mệnh giá</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
<table border="1" width="400px" align="center" cellpadding="5">
<tr align="center">
	<td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Sửa mệnh giá</font></td>
</tr>
<tr align="center">
	<td>Mệnh giá</td>
</tr>
<?php
	$id = $_REQUEST['sua'];
	$q = mysqli_query($con, "select * from menhgia where id = $id");
	$num = mysqli_fetch_array($q);
	 ?>
<tr align="center">
	<td><input type="text" name="tien" value="<?php echo $num['tien']; ?>"></td>
</tr>
<tr align="center">
	<td><input type="submit" name="ok" value="Sửa"><input type="submit" name="ql" value="Quay lại"><input type="submit" name="home" value="Trang chủ"></td>
</tr>
</table>
</form>
</body>
</html>
<?php
	if(isset($_POST['ok']))
	{
		$tien = $_POST['tien'];
		$sua = suamenhgia($id, $tien);
		if($sua)
		{
			header('location:menhgia.php');
		}
		else echo "<script>alert('Sửa không thành công')</script>";
	}
	if(isset($_POST['ql']))
	{
		header('location:menhgia.php');
	}
	if(isset($_POST['home']))
	{
		header('location:home.php');
	}
?>