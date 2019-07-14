<?php
	require_once("connect.php");
	require_once("ham.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sửa danh bạ</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
<table border="1" align="center" cellpadding="5" width="400px">
<tr align="center">
	<td colspan="2"><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Sửa danh bạ</font></td>
</tr>
<tr align="center">
	<td>Tên</td>
    <td>Số điện thoại</td>
</tr>
<?php 
	$id = $_REQUEST['sua'];
	$q = mysqli_query($con, "select * from danhba where id = $id");
	$num = mysqli_fetch_array($q);
	?>
<tr align="center">
		<td><input type="text" name="ten" value="<?php echo $num['ten']; ?>"></td>
        <td><input type="text" name="sdt" value="<?php echo $num['sdt']; ?>"></td>
</tr>
<tr align="center">
	<td colspan="2"><input type="submit" name="ok" value="Sửa"><input type="submit" name="ql" value="Quay lại"><input type="submit" name="home" value="Trang chủ"></td>
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
		$sua = suadb($id, $ten, $sdt);
		if($sua)
		{
			echo "<script>alert('Sửa thành công')</script>";
			header('location:danhba.php');
		}
		else echo "<script>alert('Sửa không thành công')</script>";
	}
	if(isset($_POST['home']))
	{
		header('location:home.php');
	}
	if(isset($_POST['ql']))
	{
		header('location:danhba.php');
	}
?>