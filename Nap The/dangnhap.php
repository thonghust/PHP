<?php
require_once("connect.php");
require_once("ham.php");
session_start();
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Đăng nhập</title>
</head>
<body>
	<form method="post" enctype="multipart/form-data">
		<table align="center" border="1" cellpadding="5" width="400px">
			<tr align="center">
				<td colspan="2"><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Đăng nhập</font></td>
			</tr>
			<tr align="center">
				<td>Tên đăng nhập</td>
				<td><input type="text" name="tk"></td>
			</tr>
			<tr align="center">
				<td>Mật khẩu</td>
				<td><input type="password" name="mk"></td>
			</tr>
			<tr align="center">
				<td colspan="2"><input type="submit" name="ok" value="Đăng nhập"><input type="submit" name="dk" value="Tạo tài khoản mới"></td>
			</tr>
		</table>
	</form>
</body>
</html>
<?php
if(isset($_POST['ok']))
{
	$tk = $_POST['tk'];
	$mk = $_POST['mk'];
	if(empty($tk))
	{
		echo "<script>alert('Tên đăng nhập không được để trống')</script>";
	}
	if(empty($mk))
	{
		echo "<script>alert('Bạn chưa nhập mật khẩu')</script>";
	}
	else
	{
		$dn = dangnhap($tk, $mk);
		$_SESSION['tk'] = $_POST['tk'];
	}
}
if(isset($_POST['dk']))
{
	header('location:dangky.php');
}
?>