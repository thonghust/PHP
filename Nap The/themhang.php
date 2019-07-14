<?php
	require_once("connect.php");
	require_once("ham.php"); 
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>THÊM HÃNG THẺ</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
<table border="1" align="center" cellpadding="5" width="400px">
<tr align="center">
	<td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Thêm hãng</font></td>
</tr>
<tr align="center">
	<td><input type="text" name="hang"></td>
</tr>
<tr align="center">
	<td><input type="submit" name="ok" value="Thêm"><input type="submit" name="ql" value="Quản lỹ hãng thẻ"><input type="submit" name="nap" value="Nạp tiền"><input type="submit" name="home" value="Trang chủ"></td>
</tr>
</table>
</form>
</body>
</html>
<?php
	if(isset($_POST['ok']))
	{
		$hang = $_POST['hang'];
		if(empty($hang))
		{
			echo "<script>alert('Bạn chưa nhập dữ liệu')</script>";
		}
		else
		{
			$themhang = themhang($hang);
			if($themhang) echo "<script>alert('Thêm thành công')</script>";
			else echo "<script>alert('Thêm không thành công')</script>";
		}
	}
	if(isset($_POST['nap']))
	{
		header('location:bai1.php');
	}
	if(isset($_POST['home']))
	{
		header('location:home.php');
	}
	if(isset($_POST['ql']))
	{
		header('location:hangthe.php');
	}
?>