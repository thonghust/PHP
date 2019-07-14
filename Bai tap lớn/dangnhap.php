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
<div style="width:1000px; height:700px; background:#ffc; margin:auto" align="center">
<img src="img/banner3.jpg" width="1000px" height="200px"><br>
<h1 style="color:#FFF; font-weight:bold; font-size:26px; font-family:Tahoma, Geneva, sans-serif; background-color:#00F">» Trang tin tức hay nhất Việt Nam «</h1>
<font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold; font-size:20px; color:#00F">Đăng nhập</font><br><br>
<table align="center" border="1" cellpadding="5" width="400px">
<tr align="center">
	<td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold; font-size:15px; color:#00F">Tài khoản</font></td>
    <td><input type="text" name="tk"></td>
</tr>
<tr align="center">
	<td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold; font-size:15px; color:#00F">Mật khẩu</font></td>
    <td><input type="password" name="mk"></td>
</tr>
<tr  align="center">
	<td colspan="2"><input type="submit" name="ok" value="Đăng nhập"><input type="submit" name="dk" value="Đăng ký"><input type="submit" name="home" value="Trang chủ"></td>
</tr>
</table>
</div>
</form>
</body>
</html>
<?php
	if(isset($_POST['ok']))
	{
		$tk = $_POST['tk'];
		$mk = $_POST['mk'];
		$k = mysqli_query($con, "select * from taikhoan where taikhoan = '$tk'");
		$num = mysqli_fetch_array($k);
		if(empty($tk))
		{
			echo "<script>alert('Tên tài khoản không được để trống')</script>";
		}
		if(empty($mk))
		{
			echo "<script>alert('Bạn chưa nhập mật khẩu')</script>";
		}
		else if($num['block'] == "block")
		{
			echo "<script>alert('Tài khoản của bạn đã bị block vĩnh viễn vì vi phạm nội quy trang web, hãy liên hệ với người quản trị để được trợ giúp')</script>";
		}
		else
		{
			$dn = dangnhap($tk, $mk);
			$_SESSION['tk'] = $_POST['tk'];
			$_SESSION['mk'] = $_POST['mk'];
			$a = $_POST['tk'];
			$q = mysqli_query($con, "select * from taikhoan where taikhoan = '$a'");
			$b = mysqli_fetch_array($q);
			$_SESSION['id_tk'] = $b['id'];
		}
	}
	if(isset($_POST['dk']))
	{
		header('location:dangky.php');
	}
	if(isset($_POST['home']))
	{
		header('location:home.php');
	}
?>