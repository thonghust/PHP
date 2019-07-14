<?php
	require_once("connect.php");
	require_once("ham.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Thêm mệnh giá</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
<table border="1" align="center" cellpadding="5" width="400px">
<tr align="center">
	<td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Thêm mệnh giá</font></td>
</tr>
<tr align="center">
	<td><input type="text" name="tien"></td>
</tr>
<tr align="center">
	<td><input type="submit" name="ok" value="Thêm"><input type="submit" name="mg" value="Quản lý mệnh giá"><input type="submit" name="naptien" value="Nạp tiền"><input type="submit" name="home" value="Trang chủ"></td>
</tr>
</table>
</form>
</body>
</html>
<?php
	if(isset($_POST['ok']))
	{
		$tien = $_POST['tien'];
		if(empty($tien))
		{
			echo "<script>alert('Bạn chưa nhập dữ liệu')</script>";
		}
		else
		{
			$themtien = themmenhgia($tien);
			if($themtien) echo "<script>alert('Thêm thành công')</script>";
			else echo "<script>alert('Thêm không thành công')</script>";
		}
	}
	if(isset($_POST['mg']))
	{
		header('location:menhgia.php');
	}
	if(isset($_POST['home']))
	{
		header('location:home.php');
	}
	if(isset($_POST['naptien']))
	{
		header('location:bai1.php');
	}
?>