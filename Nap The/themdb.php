<?php
	require_once("connect.php");
	require_once("ham.php");
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Thêm danh bạ</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
<table align="center" border="1" width="400px" cellpadding="5">
<tr>
	<td colspan="2" align="center"><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Thêm danh bạ</font></td>
</tr>
<tr align="center">
	<td>Tên</td>
    <td>Số điện thoại</td>
</tr>
<tr align="center">
	<td><input type="text" name="ten"></td>
    <td><input type="text" name="sdt"></td>
</tr>
<tr align="center">
	<td colspan="2"><input type="submit" name="ok" value="Thêm"><input type="submit" name="db" value="Quản lý danh bạ"><input type="submit" name="nap" value="Nạp tiền"><input type="submit" name="home" value="Trang chủ"></td>
</tr>
</table>
</form>
</body>
</html>
<?php
	if(isset($_POST['ok']))
	{
		$ten = $_POST['ten'];
		$sdt = $_POST['sdt'];
		if(empty($ten))
		{
			echo "<script>alert('Bạn chưa nhập tên')</script>";
		}
		if(empty($sdt))
		{
			echo "<script>alert('Bạn chưa nhập số điện thoại')</script>";
		}
		if(empty($ten) == 0 && empty($sdt) == 0)
		{
			$themdb = themdb($ten, $sdt);
			if($themdb) echo "<script>alert('Thêm thành công')</script>";
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
	if(isset($_POST['db']))
	{
		header('location:danhba.php');
	}
?>