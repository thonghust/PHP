<?php
	require_once("connect.php"); 
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Thống kê tài khoản</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
<table align="center" border="1" cellpadding="5" width="400px">
<tr align="center">
	<td colspan="2"><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Thống kê tài khoản</font></td>
</tr>
<tr align="center">
	<td>Tên tài khoản</td>
    <td>Mật khẩu</td>
</tr>

<?php
	$q = mysqli_query($con, "select * from taikhoan");
	while($num = mysqli_fetch_array($q))
	{ ?> 
<tr align="center">
	<td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold"><?php echo $num['taikhoan']; ?></font></td>
    <td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold"><?php echo $num['matkhau']; ?></font></td>
</tr>
    <?php } ?>
<tr align="center">
	<td colspan="2"><input type="submit" name="home" value="Trang chủ"></td>
</tr>
</table>
</form>
</body>
</html>
<?php
	if(isset($_POST['home']))
	{
		header('location:home.php');
	}
?>