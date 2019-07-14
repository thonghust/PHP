<?php
	require_once("connect.php");
	require_once("ham.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Kiểm Tra Tài Khoản</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
<table align="center" border="1" cellpadding="5">
<tr align="center">
	<td colspan="2"><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Kiểm tra tài khoản</font></td>
</tr>
<tr align="center">
	<td>Số điện thoại</td>
    <td><input type="text" name="sdt"></td> 
<tr align="center">
    <td colspan="2"><input type="submit" name="ok" value="Kiểm Tra"><input type="submit" name="nap" value="Nạp tiền"><input type="submit" name="home" value="Trang chủ"></td>
</tr>
</table>
</form>
</body>
</html>
<?php
	if(isset($_POST['ok']))
	{
		$sdt = $_POST['sdt'];
		if(empty($sdt))
		{
			echo "<script>alert('Bạn chưa nhập SĐT')</script>";
		}
		else
		{
			$kt = kiemtra($sdt);
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
?>