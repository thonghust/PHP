<?php
	require_once("connect.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Quản lý mệnh giá</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
<table align="center" border="1" width="400px" cellpadding="5">
<tr align="center">
	<td colspan="3"><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Mệnh giá thẻ</font></td>
</tr>
<tr align="center">
	<td width="230px">Mệnh giá</td>
    <td colspan="2">Tùy chọn</td>
</tr>
<?php
	$q = mysqli_query($con, "select * from menhgia");
	while($num = mysqli_fetch_array($q))
	{ ?>
    <tr align="center">
    	<td><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold"><?php echo $num['tien']; ?></font></td>
        <td><a href='xoamenhgia.php?xoa="<?php echo $num['id'];?>"' onClick="if(confirm('Bạn có muốn xóa?')) return true; else return false;">Xóa</a></td>
        <td align="center"><a href='suamenhgia.php?sua="<?php echo $num['id']?>"'>Sửa</a></td>
    </tr>
    <?php } ?>
<tr align="center">
	<td colspan="3"><input type="submit" name="nap" value="Nạp tiền"><input type="submit" name="them" value="Thêm mệnh giá mới"><input type="submit" name="home" value="Trang chủ"></td>
</tr>
</table>
</form>
</body>
</html>
<?php
	if(isset($_POST['nap']))
	{
		header('location:bai1.php');
	}
	if(isset($_POST['them']))
	{
		header('location:themmenhgia.php');
	}
	if(isset($_POST['home']))
	{
		header('location:home.php');
	}
?>