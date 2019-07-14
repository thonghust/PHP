<?php
	require_once("connect.php");
	require_once("ham.php");
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Quản lý danh bạ</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
<table align="center" border="1" width="400px" cellpadding="5">
<tr align="center">
	<td colspan="4"><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Danh bạ</font></td>
</tr>
<tr align="center">
	<td>Tên</td>
    <td>Số điện thoại</td>
    <td colspan="2">Tùy chọn</td>
</tr>

	<?php
		$q = mysqli_query($con, "select * from danhba");
		while($num = mysqli_fetch_array($q))
		{ ?>
<tr>
			<td align="center"><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold"><?php echo $num['ten']; ?></font></td>
            <td>
            	<input type="radio" name="sdt" value="<?php echo $num['sdt']; ?>"><?php echo $num['sdt']; ?><br>
            </td>
            <td align="center"><a href='xoadb.php?xoa="<?php
				echo $num['id'];?>"'
				onClick="if(confirm('Bạn có muốn xóa?')) return true; else return false;">Xóa</a></td>
                <td align="center"><a href='suadb.php?sua="<?php echo $num['id']?>"'>Sửa </a></td>
</tr>
		<?php } ?>
<tr align="center">
	<td colspan="4"><input type="submit" name="ok" value="Lấy số"><input type="submit" name="themdb" value="Thêm mới"><input type="submit" name="ql" value="Quay lại"><input type="submit" name="home" value="Trang chủ"></td>
</tr>
</table></form>
</body>
</html>
<?php
	if(isset($_POST['ok']))
	{
		$_SESSION['sdt'] = $_POST['sdt'];
		header('location:bai1.php');	
	}
	if(isset($_POST['themdb']))
	{
		header('location:themdb.php');
	}
	if(isset($_POST['home']))
	{
		header('location:home.php');
	}
	if(isset($_POST['ql']))
	{
		header('location:bai1.php');
	}
?>