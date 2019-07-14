<?php
	require_once("connect.php"); 
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Thống kê</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
<table align="center" border="1" cellpadding="5" width="500px">
<tr align="center">
	<td colspan="3"><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Thống kê</font></td>
</tr>
<tr align="center">
	<td>Số điện thoại</td>
    <td>Hãng điện thoại</td>
    <td>Số tiền</td>
</tr>

<?php
	$q = mysqli_query($con, "select * from thongtin");
	while($num = mysqli_fetch_array($q))
	{ ?> 
<tr align="center">
	<td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold"><?php echo $num['sdt']; ?></font></td>
    <td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold"><?php echo $num['hang']; ?></font></td>
    <td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold"><?php echo $num['sotien']; ?></font></td>
</tr>
    <?php } ?>
<tr align="center">
	<td colspan="3"><input type="submit" name="home" value="Trang chủ"></td>
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