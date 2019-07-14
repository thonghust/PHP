<?php
require_once("connect.php");
require_once("ham.php");
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Đăng ký tài khoản</title>
</head>
<body>
	<form method="post" enctype="multipart/form-data">
		<table align="center" border="1" cellpadding="5" width="400px">
			<tr align="center">
				<td colspan="2"><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Đăng ký tài khoản</font></td>
			</tr>
			<tr align="center">
				<td>Tên tài khoản</td>
				<td><input type="text" name="tk"></td>
			</tr>
			<tr align="center">
				<td>Mật khẩu</td>
				<td><input type="password" name="mk"></td>
			</tr>
			<tr align="center">
				<td>Nhập lại mật khẩu</td>
				<td><input type="password" name="nlmk"></td>
			</tr>
			<tr align="center">
				<td colspan="2"><input type="submit" name="ok" value="Đăng ký"><input type="submit" name="dn" value="Đăng nhập ngay"></td>
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
	$nlmk = $_POST['nlmk'];
	if(empty($tk))
	{
		echo "<script>alert('Tên tài khoản không được để trống')</script>"; 
	}
	if(empty($mk))
	{
		echo "<script>alert('Bạn chưa nhập mật khẩu')</script>";
	}
	if(empty($nlmk))
	{
		echo "<script>alert('Bạn chưa nhập lại mật khẩu')</script>";
	}
	else if($mk!=$nlmk)
	{
		echo "<script>alert('Mật khẩu không trùng khớp')</script>";
	}
	else
	{
		$dk = dangky($tk, $mk);
	}
}
if(isset($_POST['dn']))
{
	header('location:dangnhap.php');
}
?>